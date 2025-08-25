<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;

class DashboardPasswords extends Component
{
    // Propiedades del formulario
    public $passwordId;
    public $name;
    public $password_input;
    public $password_input_confirmation; // Nombre correcto para la confirmación
    public $url;
    public $two_factor_secret;
    public $notes;
    public $attachments = [];

    // Estado del componente
    public $passwords;
    public $showPasswordId = null;
    public $isEditing = false;

    public function mount()
    {
        $this->loadPasswords();
    }

    protected function loadPasswords()
    {
        $this->passwords = Auth::user()->passwords()->get();
    }

    protected function rules()
    {
        $passwordRules = ['string', 'min:8'];
        
        if ($this->isEditing) {
            array_unshift($passwordRules, 'nullable'); 
        } else {
            array_unshift($passwordRules, 'required');
        }

        // La regla 'confirmed' busca automáticamente el campo 'password_input_confirmation'
        $passwordRules[] = 'confirmed';

        return [
            'name' => ['required', 'string', 'max:255'],
            'password_input' => $passwordRules,
            // No necesitamos una regla explícita para 'password_input_confirmation' aquí,
            // la regla 'confirmed' en 'password_input' lo maneja.
            'url' => ['nullable', 'url', 'max:255'],
            'two_factor_secret' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'attachments' => ['nullable'],
        ];
    }
    

    public function savePassword()
    {
        $this->validate();

        $encryptedPassword = Crypt::encryptString($this->password_input);

        Auth::user()->passwords()->create([
            'name' => $this->name,
            'encrypted_password' => $encryptedPassword,
            'url' => $this->url,
            'two_factor_secret' => $this->two_factor_secret,
            'notes' => $this->notes,
            'attachments' => $this->attachments,
        ]);

        $this->resetForm();
        $this->loadPasswords();

        session()->flash('message', 'Contraseña guardada correctamente.');
    }

    public function editPassword(Password $password)
    {
        $this->isEditing = true;
        $this->passwordId = $password->id;
        $this->name = $password->name;
        $this->url = $password->url;
        $this->two_factor_secret = $password->two_factor_secret;
        $this->notes = $password->notes;
        $this->attachments = $password->attachments;
        // Reiniciamos los campos de contraseña para que el usuario pueda introducir una nueva si lo desea
        $this->password_input = ''; 
        $this->password_input_confirmation = '';
    }

    public function updatePassword()
    {
        $this->validate();

        $password = Auth::user()->passwords()->find($this->passwordId);
        if (!$password) {
            session()->flash('error', 'Contraseña no encontrada.');
            $this->resetForm();
            return;
        }

        $updateData = [
            'name' => $this->name,
            'url' => $this->url,
            'two_factor_secret' => $this->two_factor_secret,
            'notes' => $this->notes,
            'attachments' => $this->attachments,
        ];
        
        if (!empty($this->password_input)) {
            $updateData['encrypted_password'] = Crypt::encryptString($this->password_input);
        }

        $password->update($updateData);

        $this->resetForm();
        $this->loadPasswords();
        session()->flash('message', 'Contraseña actualizada correctamente.');
    }

    public function deletePassword(Password $password)
    {
        $password->delete();
        $this->loadPasswords();
        session()->flash('message', 'Contraseña eliminada correctamente.');
    }

    public function cancelEdit()
    {
        $this->isEditing = false;
        $this->resetForm();
    }

    public function getDecryptedPassword($passwordId)
    {
        $password = $this->passwords->firstWhere('id', $passwordId);
        if ($password) {
            return Crypt::decryptString($password->encrypted_password);
        }
        return '';
    }

    public function togglePasswordVisibility($passwordId)
    {
        $this->showPasswordId = ($this->showPasswordId === $passwordId) ? null : $passwordId;
    }

    protected function resetForm()
    {
        $this->passwordId = null;
        $this->name = '';
        $this->password_input = '';
        $this->password_input_confirmation = ''; // Nombre correcto para la confirmación
        $this->url = '';
        $this->two_factor_secret = '';
        $this->notes = '';
        $this->attachments = [];
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.dashboard-passwords');
    }
}

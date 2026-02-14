<?php

use Livewire\Component;

new class extends Component
{
    public string $newMessage = '';
    public string $placeholder = '';
    public Component $compo;
};
?>

<div class="form-group">
    <textarea 
        type="text"
        wire:model="newMessage"
        class="form-control message-input" 
        placeholder="{{$placeholder}}" >
    </textarea>
    {{-- <label wire:text="newMessage"></label> --}}
</div>
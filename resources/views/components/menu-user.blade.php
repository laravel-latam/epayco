<div>
    
    <!-- Account Management -->
    <div class="block px-4 py-2 text-xs text-gray-400">
        {{ __('Billing') }}
    </div>
    <x-jet-dropdown-link href="{{ route('profile.show') }}">
        {{ __('Payment methods') }}
    </x-jet-dropdown-link>
    <x-jet-dropdown-link href="{{ route('profile.show') }}">
        {{ __('Balance') }}
    </x-jet-dropdown-link>
    <x-jet-dropdown-link href="{{ route('profile.show') }}">
        {{ __('Payments') }}
    </x-jet-dropdown-link>
    <x-jet-dropdown-link href="{{ route('profile.show') }}">
        {{ __('Plans') }}
    </x-jet-dropdown-link>
    <x-jet-dropdown-link href="{{ route('profile.show') }}">
        {{ __('Subscriptions') }}
    </x-jet-dropdown-link>
    <div class="border-t border-gray-100"></div>
</div>
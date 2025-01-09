@php
    use Carbon\Carbon;
    $date_now = Carbon::now();
@endphp

<form id="appointment-form" class="flex flex-col md:flex-row justify-between md:items-center mt-6 gap-4" method="POST" action="/create-appontment">
    @csrf
    <input type="hidden" name="user_email" value="{{ Auth::user()->email }}">
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

    <div class="flex-1">
        <x-input-label for="appointment_date">
            {{ __('Datum') }}
            <x-text-input type="date" class="border border-gray-400 w-full" id="appointment_date" name="appointment_date"
                          value="{{ $date_now->toDateString() }}" min="{{ $date_now->toDateString() }}" max="2030-12-31" required />
        </x-input-label>
        <x-input-error :messages="$errors->get('appointment_date')" class="mt-2" />
    </div>

    <div class="flex-1">
        <x-input-label for="title">
            {{ __('Bezeichnung') }}
            <x-text-input id="title" type="text" name="title" required minlength="4" maxlength="50" size="55" placeholder="Bezeichnung" class="border border-gray-400" />
        </x-input-label>
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div class="flex-1">
        <x-input-label for="reminder_time">
            {{ __('Erinnerung') }}
            <select name="reminder_time" id="reminder_time" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2" required>
                <option disabled selected>{{ __('-- bitte Auswählen --') }}</option>
                <option value="1">{{ __('1 Tag') }}</option>
                <option value="2">{{ __('2 Tage') }}</option>
                <option value="4">{{ __('4 Tage') }}</option>
                <option value="7">{{ __('1 Woche') }}</option>
                <option value="14">{{ __('2 Wochen') }}</option>
            </select>
        </x-input-label>
        <x-input-error :messages="$errors->get('reminder_time')" class="mt-2" />
    </div>

    <x-primary-button class="mt-5">
        {{ __('Speichern') }}
    </x-primary-button>
</form>

@if (session('success'))
    <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-5" role="alert">
        <strong class="font-bold">{{ __('Erfolgreich gespeichert!') }}</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
        <span class="close absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>{{ __('Schließen') }}</title>
                <path fill-rule="evenodd" d="M14.95 5.05a.75.75 0 0 1 1.06 1.06L11.06 10l4.95 4.95a.75.75 0 0 1-1.06 1.06L10 11.06l-4.95 4.95a.75.75 0 0 1-1.06-1.06L8.94 10 4.99 5.05a.75.75 0 0 1 1.06-1.06L10 8.94l4.95-4.95z"></path>
            </svg>
        </span>
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('success-alert').style.display = 'none';
        }, 4000);
        document.querySelector('.close').addEventListener('click', function() {
            document.getElementById('success-alert').style.display = 'none';
        });
    </script>
@endif

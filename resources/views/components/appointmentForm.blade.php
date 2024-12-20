@php
    use Carbon\Carbon;$date_now = Carbon::now();
@endphp

<form id="appointment-form" class="flex justify-between items-center mt-6 gap-4" method="POST"
      action="/create-appointment">
    @csrf
    <input type="hidden" name="user_email" value="{{Auth::user()->email}}">
    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
    <div class="flex-1">
        <label for="appointment_date" class="mb-4 font-bold inline-flex">Datum</label>
        <input type="date"
               class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5"
               id="appointment_date" name="appointment_date"
               value="{{  $date_now->toDateString()}}" min="{{  $date_now->toDateString()}}"
               max="2030-12-31" required/>
    </div>
    <div class="flex-1">
        <label for="title" class="mb-4 font-bold inline-flex">
            Bezeichnung
        </label>
        <input type="text" name="title" required minlength="4" maxlength="50" size="55"
               placeholder="Bezeichnung"
               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5">
    </div>
    <div class="flex-1">
        <label for="reminder_time" class="mb-4 font-bold inline-flex">Erinnerung</label>
        <select name="reminder_time"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
            <option disabled selected>-- bitte auswählen --</option>
            <option value="1">1 Tag</option>
            <option value="2">2 Tage</option>
            <option value="4">4 Tage</option>
            <option value="7">1 Woche</option>
            <option value="14">2 Wochen</option>
        </select>
    </div>
    <x-primary-button class="mt-9">
        Speichern
    </x-primary-button>
</form>

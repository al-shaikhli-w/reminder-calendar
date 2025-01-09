@props(['appointment_date', 'title', 'reminder_time', 'current_appointment'])

<tbody class="mt-5">
<tr class="border-b border-gray-400">
    <th scope="row" class="py-4 font-medium text-gray-900 whitespace-nowrap">
        {{ $appointment_date }}
    </th>
    <td class="py-4">
        {{ $title }}
    </td>
    <td class="py-4">
        {{ $reminder_time }} {{ $reminder_time == 1 ? 'Tag' : 'Tage' }}
    </td>
    <td class="flex items-center py-4">
        <x-modal :current_appointment="$current_appointment" :reminder_time="$reminder_time" :title="$title" :appointment_date="$appointment_date">
            {{ __(' Bearbeiten') }}
        </x-modal>
        <p class="mx-2">|</p>
        <form action="/delete-appointment/{{ $current_appointment }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="font-medium text-red-600 hover:underline">
                {{ __('Löschen') }}
            </button>
        </form>
    </td>
</tr>
</tbody>

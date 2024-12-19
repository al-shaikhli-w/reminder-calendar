@props(['appointment_date' => 'bg-blue-100', 'title' => 'title', 'reminder_time' => '1'])

<tbody class="mt-5">
    <tr class="border-b border-gray-400">
        <th scope="row" class="py-4 font-medium text-gray-900 whitespace-nowrap">
            {{$appointment_date}}
        </th>
        <td class="py-4">
            {{$title}}
        </td>
        <td class="py-4">
            {{$reminder_time}}
        </td>

        <td class="flex items-center py-4">
            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Bearbeiten</a>
            <p class="mx-2">|</p>
            <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Löschen</a>
        </td>
    </tr>
</tbody>



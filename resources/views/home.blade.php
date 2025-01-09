<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @auth
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="py-6 px-4">
                        <p>Willkommen, {{ Auth::user()->name }}!</p>
                        <x-appointmentForm></x-appointmentForm>
                        @if(isset($appointments) && count($appointments) > 0)
                            <section class="bg-gray-200 p-4 mt-8 rounded-xl md:p-8">
                                <h3 class="text-2xl font-bold">Kalender</h3>
                                <div class="relative overflow-x-auto mt-6">
                                    <table class="w-full text-sm text-left mb-6">
                                        <thead class="text-xs text-gray-700 uppercase">
                                        <tr class="font-bold">
                                            <th scope="col" class="text-xl font-bold">Datum</th>
                                            <th scope="col" class="text-xl font-bold">Bezeichnung</th>
                                            <th scope="col" class="text-xl font-bold">Erinnerung</th>
                                            <th scope="col" class="text-xl font-bold">Aktion</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($appointments as $appointment)
                                            <x-appointment
                                                appointment_date="{{ $appointment->appointment_date }}"
                                                title="{{ $appointment->title }}"
                                                reminder_time="{{ $appointment->reminder_time }}"
                                                current_appointment="{{ $appointment->id }}"
                                            />
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        @else
                            <p class="mt-6">Noch keine Termine? Erstelle einen neuen Termin!</p>
                        @endif
                    </div>
                </div>
            @endauth
            @guest
                <section class="guest mt-6">
                    <h2 class="text-2xl mb-3 font-bold">Was ist Reminder Calendar?</h2>
                    <p>Das Leben ist hektisch und es ist leicht, die kleinen Dinge zu vergessen. <strong>Reminder Calendar</strong> ist hier, um zu helfen! Ob es sich um ein Meeting, einen Geburtstag oder einfach nur um eine Aufgabe handelt, die Sie nicht vergessen dürfen, unsere App erstellt einen personalisierten Erinnerungskalender, der auf Ihre Bedürfnisse zugeschnitten ist. Wir senden Ihnen sogar rechtzeitige Erinnerungs-E-Mails, um sicherzustellen, dass Sie immer auf dem Laufenden sind.</p>

                    <h2 class="text-2xl mb-3 mt-6 font-bold">Warum Reminder Calendar wählen?</h2>
                    <ul>
                        <li><strong>🕒 Individuelle Erinnerungen:</strong> Legen Sie Erinnerungen für jedes Ereignis oder jede Aufgabe fest, zu jeder Zeit, die Ihnen passt.
                        </li>
                        <li><strong>📧 E-Mail-Benachrichtigungen:</strong> Erhalten Sie freundliche Erinnerungs-E-Mails genau dann, wenn Sie sie benötigen.
                        </li>
                        <li><strong>📅 Einfach & Intuitiv:</strong> Verwalten Sie Ihre Erinnerungen ganz einfach mit einer sauberen, benutzerfreundlichen Oberfläche.
                        </li>
                        <li><strong>🔒 Sicher & Privat:</strong> Ihre Daten sind bei uns sicher. Wir legen großen Wert auf Ihre Privatsphäre und Sicherheit.
                        </li>
                    </ul>

                    <h2 class="text-2xl mb-3 mt-6 font-bold">Wie es funktioniert</h2>
                    <ol>
                        <li><strong>Erstellen Sie Ihre Erinnerung:</strong> Wählen Sie ein Datum, eine Uhrzeit und fügen Sie eine Beschreibung für Ihre Aufgabe oder Ihr Ereignis hinzu.
                        </li>
                        <li><strong>Passen Sie Ihre Benachrichtigung an:</strong> Legen Sie fest, wann und wie oft Sie erinnert werden möchten.
                        </li>
                        <li><strong>Lehnen Sie sich zurück & entspannen Sie sich:</strong> Wir senden Ihnen eine E-Mail-Erinnerung, damit Sie nichts verpassen.
                        </li>
                    </ol>

                    <h2 class="text-2xl mb-3 mt-6 font-bold">Für wen ist es?</h2>
                    <ul class="list-item">
                        <li>- Berufstätige</li>
                        <li>- Studenten, die Fristen verwalten</li>
                        <li>- Familien, die Veranstaltungen planen</li>
                        <li>- Jeder, der Wert auf Organisation und Pünktlichkeit legt</li>
                    </ul>

                    <div class="cta">
                        <p class="mb-6 mt-3">Lassen Sie wichtige Momente nicht durch die Lappen gehen. Schließen Sie sich Tausenden von Nutzern an, die <strong>Reminder Calendar</strong> vertrauen, um organisiert zu bleiben.</p>
                        <a href="{{route("register")}}" class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-800 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Jetzt kostenlos anmelden!</a>
                    </div>
                </section>
            @endguest
        </div>
    </div>
</x-app-layout>

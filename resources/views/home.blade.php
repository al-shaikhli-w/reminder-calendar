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
                    <h2 class="text-2xl mb-3 font-bold">What is Reminder Calendar?</h2>
                    <p>Life is busy, and it’s easy to forget the little things. <strong>Reminder Calendar</strong> is
                        here to help! Whether it’s a meeting, a birthday, or just a task you can’t afford to forget, our
                        app creates a personalized reminder calendar tailored to your needs. We’ll even send you timely
                        reminder emails to ensure you’re always on track.</p>

                    <h2 class="text-2xl mb-3 mt-6 font-bold">Why Choose Reminder Calendar?</h2>
                    <ul>
                        <li><strong>🕒 Custom Reminders:</strong> Set reminders for any event or task, at any time that
                            suits you.
                        </li>
                        <li><strong>📧 Email Notifications:</strong> Receive friendly reminder emails exactly when you
                            need them.
                        </li>
                        <li><strong>📅 Simple & Intuitive:</strong> Easily manage your reminders with a clean,
                            user-friendly interface.
                        </li>
                        <li><strong>🔒 Secure & Private:</strong> Your data is safe with us. We prioritize your privacy
                            and security.
                        </li>
                    </ul>

                    <h2 class="text-2xl mb-3 mt-6 font-bold">How It Works</h2>
                    <ol>
                        <li><strong>Create Your Reminder:</strong> Pick a date, time, and add a description for your
                            task or event.
                        </li>
                        <li><strong>Customize Your Notification:</strong> Set when and how often you’d like to be
                            reminded.
                        </li>
                        <li><strong>Sit Back & Relax:</strong> We’ll send you an email reminder so you’ll never miss a
                            thing.
                        </li>
                    </ol>

                    <h2 class="text-2xl mb-3 mt-6 font-bold">Who Is It For?</h2>
                    <ul class="list-item">
                        <li>- Busy professionals</li>
                        <li>- Students managing deadlines</li>
                        <li>- Families planning events</li>
                        <li>- Anyone who values organization and punctuality</li>
                    </ul>

                    <div class="cta">
                        <p class="mb-6 mt-3">Don’t let important moments slip through the cracks. Join thousands of
                            users who trust <strong>Reminder Calendar</strong> to keep them organized.</p>
                        <a href="{{route("register")}}"
                           class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-800 border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Sign
                            Up Now For free!</a>
                    </div>
                </section>
            @endguest
        </div>
    </div>
</x-app-layout>

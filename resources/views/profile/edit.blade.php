<x-app-layout>
    {{-- Hero Section --}}
    <section class="relative h-[400px] bg-cover bg-center"
        style="background-image:url('https://img.freepik.com/premium-photo/luggage-with-woven-beach-hat-sunglasses_1096472-17191.jpg')">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative max-w-6xl mx-auto pt-32 px-6 text-white text-center">
            <h1 class="text-4xl font-bold mb-4">Profile Settings</h1>
            <p class="mb-6">Update your personal information and manage your account settings.</p>
        </div>
    </section>

    {{-- Profile Forms Section --}}
    <section class="max-w-7xl mx-auto px-6 py-10">
        <h2 class="text-2xl font-bold mb-6">Manage Your Profile</h2>
        <div class="grid md:grid-cols-1 gap-6">

            <div class="bg-white rounded shadow p-6">
                <h3 class="font-bold text-lg mb-4">Update Profile Information</h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white rounded shadow p-6">
                <h3 class="font-bold text-lg mb-4">Update Password</h3>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white rounded shadow p-6">
                <h3 class="font-bold text-lg mb-4 text-red-600">Delete Account</h3>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </section>
</x-app-layout>

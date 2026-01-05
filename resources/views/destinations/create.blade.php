<x-app-layout>
    <form method="POST" action="{{ route('destinations.store') }}" class="max-w-xl mx-auto p-6">
        @csrf
        <input name="name" class="border p-2 w-full mb-2" placeholder="Name">
        <textarea name="description" class="border p-2 w-full mb-2"></textarea>
        <input name="location" class="border p-2 w-full mb-2">
        <input name="price" class="border p-2 w-full mb-2">
        <input name="latitude" class="border p-2 w-full mb-2">
        <input name="longitude" class="border p-2 w-full mb-2">
        <button class="bg-green-600 text-white px-4 py-2">Save</button>
    </form>
</x-app-layout>
<x-layout title="Add Book">
  <div class="px-6 py-8">
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-2xl font-semibold text-white">Add New Book</h1>
        <p class="mt-1 text-sm text-gray-300">Complete the form to save a new book record.</p>
      </div>
      <a href="/books" class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-white hover:bg-white/20">Back to books</a>
    </div>

    <form action="/books" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6 rounded-3xl border border-white/10 bg-slate-950/60 p-6">
      @csrf
      <div class="grid gap-4 sm:grid-cols-2">
        <div>
          <label class="block text-sm font-medium text-gray-300">Title</label>
          <input type="text" name="title" value="{{ old('title') }}" required class="mt-2 block w-full rounded-md bg-white/5 px-3 py-2 text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-300">Author</label>
          <input type="text" name="author" value="{{ old('author') }}" required class="mt-2 block w-full rounded-md bg-white/5 px-3 py-2 text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
        </div>
        <div class="sm:col-span-2">
          <label class="block text-sm font-medium text-gray-300">Description</label>
          <textarea name="description" rows="4" required class="mt-2 block w-full rounded-md bg-white/5 px-3 py-2 text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">{{ old('description') }}</textarea>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-300">Genre</label>
          <input type="text" name="genre" value="{{ old('genre') }}" required class="mt-2 block w-full rounded-md bg-white/5 px-3 py-2 text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" placeholder="Fiction, Sci-Fi, ...">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-300">Published Year</label>
          <input type="number" name="published_year" value="{{ old('published_year') }}" required class="mt-2 block w-full rounded-md bg-white/5 px-3 py-2 text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-300">ISBN</label>
          <input type="text" name="isbn" value="{{ old('isbn') }}" required class="mt-2 block w-full rounded-md bg-white/5 px-3 py-2 text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-300">Pages</label>
          <input type="number" name="pages" value="{{ old('pages') }}" required class="mt-2 block w-full rounded-md bg-white/5 px-3 py-2 text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-300">Language</label>
          <input type="text" name="language" value="{{ old('language') }}" required class="mt-2 block w-full rounded-md bg-white/5 px-3 py-2 text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" placeholder="English">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-300">Publisher</label>
          <input type="text" name="publisher" value="{{ old('publisher') }}" required class="mt-2 block w-full rounded-md bg-white/5 px-3 py-2 text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-300">Price</label>
          <input type="number" step="0.01" name="price" value="{{ old('price') }}" required class="mt-2 block w-full rounded-md bg-white/5 px-3 py-2 text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
        </div>
        <div class="sm:col-span-2">
          <label class="block text-sm font-medium text-gray-300">Cover Image</label>
          <input type="file" name="cover_image" accept="image/*" class="mt-2 block w-full rounded-md bg-white/5 px-3 py-2 text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
        </div>
        <div class="sm:col-span-2 flex items-center gap-3 pt-6">
          <input type="checkbox" name="is_available" id="is_available" value="1" class="h-4 w-4 rounded border-gray-300 bg-white text-indigo-600 focus:ring-indigo-500" {{ old('is_available') ? 'checked' : '' }}>
          <label for="is_available" class="text-sm font-medium text-gray-300">Available</label>
        </div>
      </div>

      <div class="flex justify-end gap-3 pt-4">
        <a href="/books" class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-white hover:bg-white/20">Cancel</a>
        <button type="submit" class="rounded-md bg-green-500 px-4 py-2 text-sm font-semibold text-white hover:bg-green-400">Save Book</button>
      </div>
    </form>
  </div>
</x-layout>

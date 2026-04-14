<x-layout title="Book Details">
  <div class="px-6 py-8">
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-2xl font-semibold text-white">{{ $book->title }}</h1>
        <p class="mt-1 text-sm text-gray-300">Detailed book information.</p>
      </div>
      <a href="/books" class="rounded-md bg-white/10 px-4 py-2 text-sm font-semibold text-white hover:bg-white/20">Back to books</a>
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-[280px_1fr]">
      <div class="rounded-3xl border border-white/10 bg-slate-950/60 p-6">
        @if($book->cover_image)
          <img src="{{ asset($book->cover_image) }}" alt="Cover image" class="h-72 w-full rounded-2xl object-cover">
        @else
          <div class="flex h-72 items-center justify-center rounded-2xl bg-white/5 text-gray-300">No cover image</div>
        @endif
      </div>
      <div class="rounded-3xl border border-white/10 bg-slate-950/60 p-6">
        <div class="grid gap-4 text-sm text-gray-300">
          <div><span class="font-semibold text-white">Author:</span> {{ $book->author }}</div>
          <div><span class="font-semibold text-white">Genre:</span> {{ $book->genre }}</div>
          <div><span class="font-semibold text-white">Published:</span> {{ $book->published_year }}</div>
          <div><span class="font-semibold text-white">ISBN:</span> {{ $book->isbn }}</div>
          <div><span class="font-semibold text-white">Pages:</span> {{ $book->pages }}</div>
          <div><span class="font-semibold text-white">Language:</span> {{ $book->language }}</div>
          <div><span class="font-semibold text-white">Publisher:</span> {{ $book->publisher }}</div>
          <div><span class="font-semibold text-white">Price:</span> ${{ number_format($book->price, 2) }}</div>
          <div><span class="font-semibold text-white">Availability:</span> {{ $book->is_available ? 'Available' : 'Unavailable' }}</div>
          <div><span class="font-semibold text-white">Description:</span></div>
          <p class="rounded-2xl bg-white/5 p-4 text-gray-300">{{ $book->description }}</p>
        </div>
      </div>
    </div>
  </div>
</x-layout>

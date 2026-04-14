<x-layout title="Books">
  <div class="px-6 py-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
      <div>
        <h1 class="text-2xl font-semibold text-white">Books</h1>
        <p class="mt-1 text-sm text-gray-300">Search, filter, and manage your book collection.</p>
      </div>
      <a href="/books/create" class="inline-flex items-center rounded-md bg-green-500 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-400">Add New Book</a>
    </div>

    <form method="GET" action="/books" class="mt-6 rounded-xl border border-white/10 bg-slate-950/50 p-4">
      <div class="grid gap-4 sm:grid-cols-3">
        <div>
          <label class="block text-sm font-medium text-gray-300">Search title or author</label>
          <input type="search" name="search" value="{{ request('search') }}" class="mt-2 block w-full rounded-md bg-white/5 px-3 py-2 text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500" placeholder="Search...">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-300">Filter by genre</label>
          <select name="genre" class="mt-2 block w-full rounded-md bg-white/5 px-3 py-2 text-white outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
            <option value="">All genres</option>
            @foreach($genres as $genreOption)
              <option value="{{ $genreOption }}" @selected(request('genre') === $genreOption)>{{ $genreOption }}</option>
            @endforeach
          </select>
        </div>
        <div class="flex items-end">
          <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">Apply</button>
        </div>
      </div>
    </form>

    <div class="mt-6 overflow-x-auto rounded-3xl border border-white/10 bg-slate-950/40">
      <table class="min-w-full divide-y divide-gray-700">
        <thead class="bg-gray-900">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">Title</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">Author</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">Genre</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">Price</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">Availability</th>
            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-400">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-700 bg-slate-950">
          @forelse($books as $book)
            <tr>
              <td class="px-6 py-4 text-sm text-white">{{ $book->title }}</td>
              <td class="px-6 py-4 text-sm text-white">{{ $book->author }}</td>
              <td class="px-6 py-4 text-sm text-white">{{ $book->genre }}</td>
              <td class="px-6 py-4 text-sm text-white">${{ number_format($book->price, 2) }}</td>
              <td class="px-6 py-4 text-sm text-white">{{ $book->is_available ? 'Available' : 'Unavailable' }}</td>
              <td class="px-6 py-4 text-sm font-medium space-x-2">
                <a href="/books/{{ $book->id }}" class="text-indigo-400 hover:text-indigo-300">View</a>
                <a href="/books/{{ $book->id }}/edit" class="text-amber-400 hover:text-amber-300">Edit</a>
                <form action="/books/{{ $book->id }}" method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Delete this book?')">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-400">No books found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const form = document.querySelector('form[action="/books"]');
      const searchInput = form?.querySelector('input[name="search"]');
      const genreSelect = form?.querySelector('select[name="genre"]');
      const rows = Array.from(document.querySelectorAll('tbody tr')).filter(tr => !tr.querySelector('td[colspan]'));
      const noResultRow = document.querySelector('tbody tr td[colspan]')?.parentElement;

      const filterRows = () => {
        const query = searchInput?.value.trim().toLowerCase() || '';
        const genre = genreSelect?.value || '';
        let visibleCount = 0;

        rows.forEach(row => {
          const title = row.children[0]?.textContent.trim().toLowerCase() || '';
          const author = row.children[1]?.textContent.trim().toLowerCase() || '';
          const rowGenre = row.children[2]?.textContent.trim() || '';
          const matchesQuery = query === '' || title.includes(query) || author.includes(query);
          const matchesGenre = genre === '' || rowGenre === genre;

          if (matchesQuery && matchesGenre) {
            row.style.display = '';
            visibleCount += 1;
          } else {
            row.style.display = 'none';
          }
        });

        if (noResultRow) {
          noResultRow.style.display = visibleCount === 0 ? '' : 'none';
        }
      };

      form?.addEventListener('submit', function (event) {
        event.preventDefault();
        filterRows();
      });

      searchInput?.addEventListener('input', filterRows);
      genreSelect?.addEventListener('change', filterRows);
    });
  </script>
</x-layout>

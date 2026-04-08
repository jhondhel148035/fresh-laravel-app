<x-layout>
  <br><br><br><br>

  <form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="border-b border-white/10 pb-12">
      <h2 class="text-base/7 font-semibold text-white">Personal Information</h2>
      <p class="mt-1 text-sm/6 text-gray-400">Use a permanent address where you can receive mail.</p>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

        <div class="sm:col-span-2">
          <label for="first_name" class="block text-sm/6 font-medium text-white">First name</label>
          <div class="mt-2">
            <input id="first_name" type="text" name="first_name" required
              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
          </div>
        </div>

        <div class="sm:col-span-2">
          <label for="middle_name" class="block text-sm/6 font-medium text-white">Middle name</label>
          <div class="mt-2">
            <input id="middle_name" type="text" name="middle_name"
              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
          </div>
        </div>

        <div class="sm:col-span-2">
          <label for="last_name" class="block text-sm/6 font-medium text-white">Last name</label>
          <div class="mt-2">
            <input id="last_name" type="text" name="last_name" required
              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="nickname" class="block text-sm/6 font-medium text-white">Nickname</label>
          <div class="mt-2">
            <input id="nickname" type="text" name="nickname"
              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="age" class="block text-sm/6 font-medium text-white">Age</label>
          <div class="mt-2">
            <input id="age" type="number" name="age" required
              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
          </div>
        </div>

        <div class="sm:col-span-4">
          <label for="email" class="block text-sm/6 font-medium text-white">Email address</label>
          <div class="mt-2">
            <input id="email" type="email" name="email" required
              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
          </div>
        </div>

        <div class="sm:col-span-2">
          <label for="contact_number" class="block text-sm/6 font-medium text-white">Contact number</label>
          <div class="mt-2">
            <input id="contact_number" type="text" name="contact_number" required
              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
          </div>
        </div>

        <div class="col-span-full">
          <label for="address" class="block text-sm/6 font-medium text-white">Street address</label>
          <div class="mt-2">
            <textarea id="address" name="address" rows="3" required
              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"></textarea>
          </div>
        </div>

        <div class="sm:col-span-4">
          <label for="password" class="block text-sm/6 font-medium text-white">Password</label>
          <div class="mt-2">
            <input id="password" type="password" name="password" required
              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
          </div>
        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6 pb-12">
      <button type="submit"
        class="rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500">Save</button>
    </div>
  </form>

  <div class="mt-10">
    <h2 class="text-base/7 font-semibold text-white mb-4">Registered Users</h2>
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-700">
        <thead class="bg-gray-800">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Full
              Name</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
              Nickname</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Email
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Age
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
              Contact</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
              Actions</th>
          </tr>
        </thead>
        <tbody class="bg-gray-900 divide-y divide-gray-700">
          @foreach($users as $user)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->first_name }} {{ $user->middle_name }}
                {{ $user->last_name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->nickname }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->email }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->age }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $user->contact_number }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-400 hover:text-indigo-300 mr-4">Edit</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-400 hover:text-red-300"
                    onclick="return confirm('Delete this user?')">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</x-layout>
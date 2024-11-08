<x-layout>
    <x-slot:header>Contacts</x-slot>
    <button onclick="location.href='{{ route('kontaks.create') }}'" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Kontak</button>
    @foreach ($contacts as $kontak)
      <div class=" my-10">
      <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
          <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg" src="https://picsum.photos/100/100?random={{ rand() }}" alt="">
          <div class="flex flex-col justify-between p-4 leading-normal">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$kontak['nama']}}</h5>
              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$kontak['alamat']}}</p>
              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$kontak['telepon']}}</p>
              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$kontak['email']}}</p>
              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$kontak['lahir']}}</p>
              <div>
                <div class="inline-flex rounded-md shadow-sm" role="group">
                  <button onclick="location.href='{{ route('kontaks.edit',$kontak['id']) }}'" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                    Edit
                  </button>
                  <form action="{{ route('kontaks.destroy',$kontak['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                      Delete
                    </button>
                  </form>
                  <button type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                    Details
                  </button>
                </div>
              </div>
            </div>
      </a>
      </div>
    @endforeach
</x-layout>
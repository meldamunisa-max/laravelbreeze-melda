<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Data Mahasiswa') }}</h2>
            <a href="{{ route('mahasiswa.create') }}" class="inline-flex items-center justify-center rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white">
                {{ __('Tambah Mahasiswa') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="rounded-md bg-green-50 p-4 text-sm text-green-700 dark:bg-green-900/30 dark:text-green-300">{{ session('status') }}</div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr class="text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-300">
                                <th class="px-6 py-3">NIM</th>
                                <th class="px-6 py-3">Nama Mahasiswa</th>
                                <th class="px-6 py-3">Program Studi</th>
                                <th class="px-6 py-3">Jenis Kelamin</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($mahasiswa as $item)
                                <tr class="text-sm text-gray-700 dark:text-gray-300">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $item->nim }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $item->nama_mahasiswa }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $item->program_studi }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $item->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">{{ $item->email }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right">
                                        <div class="flex justify-end gap-3">
                                            <a href="{{ route('mahasiswa.show', $item) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">Detail</a>
                                            <a href="{{ route('mahasiswa.edit', $item) }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">Edit</a>
                                            <form method="POST" action="{{ route('mahasiswa.destroy', $item) }}" onsubmit="return confirm('Hapus data mahasiswa ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500 dark:text-gray-400">Belum ada data mahasiswa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($mahasiswa->hasPages())
                    <div class="border-t border-gray-200 px-6 py-4 dark:border-gray-700">{{ $mahasiswa->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Detail Mahasiswa') }}</h2>
            <div class="flex gap-3">
                <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700 dark:bg-gray-200 dark:text-gray-800">Edit</a>
                <a href="{{ route('mahasiswa.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">Kembali</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ([
                        'NIM' => $mahasiswa->nim,
                        'Nama Mahasiswa' => $mahasiswa->nama_mahasiswa,
                        'Tempat Lahir' => $mahasiswa->tempat_lahir,
                        'Tanggal Lahir' => $mahasiswa->tanggal_lahir->format('d/m/Y'),
                        'Jenis Kelamin' => $mahasiswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
                        'Alamat' => $mahasiswa->alamat,
                        'Program Studi' => $mahasiswa->program_studi,
                        'Nomor HP' => $mahasiswa->nomor_hp,
                        'Email' => $mahasiswa->email,
                    ] as $label => $value)
                        <div class="grid gap-2 px-6 py-4 sm:grid-cols-3">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $label }}</dt>
                            <dd class="text-sm text-gray-900 dark:text-gray-100 sm:col-span-2">{{ $value }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
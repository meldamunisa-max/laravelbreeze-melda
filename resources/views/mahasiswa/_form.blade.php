@csrf

<div class="grid gap-6 md:grid-cols-2">
    <div>
        <x-input-label for="nim" :value="__('NIM')" />
        <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full" :value="old('nim', $mahasiswa->nim ?? '')" required maxlength="20" />
        <x-input-error class="mt-2" :messages="$errors->get('nim')" />
    </div>

    <div>
        <x-input-label for="nama_mahasiswa" :value="__('Nama Mahasiswa')" />
        <x-text-input id="nama_mahasiswa" name="nama_mahasiswa" type="text" class="mt-1 block w-full" :value="old('nama_mahasiswa', $mahasiswa->nama_mahasiswa ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('nama_mahasiswa')" />
    </div>

    <div>
        <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
        <x-text-input id="tempat_lahir" name="tempat_lahir" type="text" class="mt-1 block w-full" :value="old('tempat_lahir', $mahasiswa->tempat_lahir ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('tempat_lahir')" />
    </div>

    <div>
        <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
        <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full" :value="old('tanggal_lahir', isset($mahasiswa) ? $mahasiswa->tanggal_lahir->format('Y-m-d') : '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('tanggal_lahir')" />
    </div>

    <div>
        <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
        <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>
            <option value="">{{ __('Pilih jenis kelamin') }}</option>
            <option value="L" @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') === 'L')>Laki-laki</option>
            <option value="P" @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') === 'P')>Perempuan</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('jenis_kelamin')" />
    </div>

    <div>
        <x-input-label for="program_studi" :value="__('Program Studi')" />
        <x-text-input id="program_studi" name="program_studi" type="text" class="mt-1 block w-full" :value="old('program_studi', $mahasiswa->program_studi ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('program_studi')" />
    </div>

    <div>
        <x-input-label for="nomor_hp" :value="__('Nomor HP')" />
        <x-text-input id="nomor_hp" name="nomor_hp" type="tel" class="mt-1 block w-full" :value="old('nomor_hp', $mahasiswa->nomor_hp ?? '')" required maxlength="20" />
        <x-input-error class="mt-2" :messages="$errors->get('nomor_hp')" />
    </div>

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $mahasiswa->email ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    <div class="md:col-span-2">
        <x-input-label for="alamat" :value="__('Alamat')" />
        <textarea id="alamat" name="alamat" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300" required>{{ old('alamat', $mahasiswa->alamat ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
    </div>
</div>

<div class="mt-6 flex items-center gap-4">
    <x-primary-button>{{ $submitLabel }}</x-primary-button>
    <a href="{{ route('mahasiswa.index') }}" class="text-sm text-gray-600 underline hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">{{ __('Batal') }}</a>
</div>
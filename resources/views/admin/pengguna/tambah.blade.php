@extends('admin.dashboard')

@section('content')

<div>
    <h2 class="text-2xl md:text-4xl font-extrabold dark:text-white mb-4">Tambah Pengguna</h2>
</div>

<div>
    <form class="max-w-sm mx-auto">
        <div class="mb-5">
            <label for="email" class="block mb-2.5 text-sm font-medium text-heading">Nama</label>
            <input type="email" id="email"
                   class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                   placeholder="nama" required/>
        </div>
        <div class="mb-5">
            <label for="email" class="block mb-2.5 text-sm font-medium text-heading">Email</label>
            <input type="email" id="email"
                   class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                   placeholder="example@tapselkab.go.id" required/>
        </div>
        <div class="mb-5">
            <label for="password" class="block mb-2.5 text-sm font-medium text-heading">Kata Sandi</label>
            <input type="password" id="password"
                   class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body"
                   placeholder="••••••••" required/>
        </div>
        <div class="mb-5">
            <label for="countries" class="block mb-2.5 text-sm font-medium text-heading">Peran</label>
            <select id="countries"
                    class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                <option selected>Pilih Peran</option>
                <option value="10">Pelihat</option>
                <option value="9">Perangkat Desa</option>
                <option value="8">Desa</option>
                <option value="7">Admin Kecamatan</option>
                <option value="6">Kecamatan</option>
                <option value="5">Admin</option>
                <!-- <option value="4">Admin 2</option>
                <option value="3">Admin 3</option>
                <option value="5">Admin 4</option>
                <option value="4">Admin 5</option>
                <option value="3">Admin 6</option>
                <option value="2">Admin 7</option>
                <option value="1">Super Admin</option> -->
            </select>
        </div>
        <div class="mb-5">
            <button type="submit"
                    class="inline-flex items-center gap-2 text-white
           bg-blue-600 hover:bg-blue-700
           focus:ring-4 focus:ring-blue-300
           font-medium text-sm px-4 py-2.5
           rounded-lg shadow-sm transition">
                Buat Akun
            </button>
        </div>
    </form>
</div>
@endsection

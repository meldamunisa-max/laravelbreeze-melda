<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MahasiswaTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_mahasiswa_crud(): void
    {
        $this->get(route('mahasiswa.index'))->assertRedirect(route('login'));
        $this->get(route('mahasiswa.create'))->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_create_read_update_and_delete_mahasiswa(): void
    {
        $user = User::factory()->create();

        $createResponse = $this->actingAs($user)->post(route('mahasiswa.store'), $this->mahasiswaData());

        $createResponse->assertSessionHasNoErrors()->assertRedirect(route('mahasiswa.index'));
        $mahasiswa = Mahasiswa::firstOrFail();
        $this->assertDatabaseHas('mahasiswa', ['nim' => '20260001', 'nama_mahasiswa' => 'Melda Sari']);

        $this->actingAs($user)->get(route('mahasiswa.index'))->assertOk()->assertSee('Melda Sari');
        $this->actingAs($user)->get(route('mahasiswa.show', $mahasiswa))->assertOk()->assertSee('Teknik Informatika');

        $updateResponse = $this->actingAs($user)->put(route('mahasiswa.update', $mahasiswa), array_merge(
            $this->mahasiswaData(),
            ['nama_mahasiswa' => 'Melda Sari Updated']
        ));

        $updateResponse->assertSessionHasNoErrors()->assertRedirect(route('mahasiswa.index'));
        $this->assertDatabaseHas('mahasiswa', ['nim' => '20260001', 'nama_mahasiswa' => 'Melda Sari Updated']);

        $deleteResponse = $this->actingAs($user)->delete(route('mahasiswa.destroy', $mahasiswa));

        $deleteResponse->assertRedirect(route('mahasiswa.index'));
        $this->assertDatabaseMissing('mahasiswa', ['nim' => '20260001']);
    }

    public function test_mahasiswa_input_is_validated(): void
    {
        $user = User::factory()->create();
        Mahasiswa::create($this->mahasiswaData());

        $response = $this->actingAs($user)->post(route('mahasiswa.store'), [
            'nim' => '20260001',
            'nama_mahasiswa' => '',
            'tanggal_lahir' => now()->addDay()->format('Y-m-d'),
            'jenis_kelamin' => 'X',
            'email' => 'not-an-email',
        ]);

        $response->assertSessionHasErrors(['nim', 'nama_mahasiswa', 'tempat_lahir', 'alamat', 'program_studi', 'nomor_hp', 'jenis_kelamin', 'email']);
    }

    /** @return array<string, string> */
    private function mahasiswaData(): array
    {
        return [
            'nim' => '20260001',
            'nama_mahasiswa' => 'Melda Sari',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2003-05-14',
            'jenis_kelamin' => 'P',
            'alamat' => 'Jl. Merdeka No. 1',
            'program_studi' => 'Teknik Informatika',
            'nomor_hp' => '081234567890',
            'email' => 'melda@example.com',
        ];
    }
}

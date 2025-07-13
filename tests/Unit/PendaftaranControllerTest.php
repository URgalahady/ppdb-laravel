<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Jurusan;
use App\Models\Gelombang;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class PendaftaranControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $controller;
    protected $user;
    protected $pendaftaran;
    protected $gelombang;

    public function setUp(): void
    {
        parent::setUp();
        
        Storage::fake('public');
        
        $this->controller = new PendaftaranController();
        
        $this->user = User::factory()->create();
        $this->gelombang = Gelombang::factory()->create([
            'tanggal_berakhir' => Carbon::tomorrow()
        ]);
        
        $this->pendaftaran = Pendaftaran::factory()->create([
            'user_id' => $this->user->id,
            'gelombang_id' => $this->gelombang->id,
            'status' => 'menunggu'
        ]);
    }

    public function test_show_redirects_when_no_pendaftaran()
    {
        $newUser = User::factory()->create();
        Auth::login($newUser);

        $response = $this->actingAs($newUser)->get(route('formulir.show'));
        
        $response->assertRedirect(route('formulir.create'));
        $response->assertSessionHas('info', 'Anda belum mengisi formulir pendaftaran.');
    }

    public function test_edit_returns_view_with_valid_data()
    {
        Auth::login($this->user);
        $jurusan = Jurusan::factory()->create(['penuh' => false]);
        
        $response = $this->actingAs($this->user)->get(route('formulir.edit'));
        
        $response->assertViewIs('pendaftaran.edit');
        $response->assertViewHas(['pendaftaran', 'jurusans', 'gelombang']);
    }

    public function test_edit_blocks_accepted_applications()
    {
        $this->pendaftaran->update(['status' => 'diterima']);
        Auth::login($this->user);

        $response = $this->actingAs($this->user)->get(route('formulir.edit'));
        
        $response->assertRedirect(route('formulir.show'));
        $response->assertSessionHas('error', 'Data tidak bisa diedit karena sudah diterima');
    }

    public function test_update_handles_file_uploads()
    {
        Auth::login($this->user);
        $jurusan = Jurusan::factory()->create();

        $data = [
            'nama' => 'Test Name',
            'tempat_lahir' => 'Test Place',
            'tanggal_lahir' => '2000-01-01',
            'asal_sekolah' => 'Test School',
            'jurusan_id' => $jurusan->id,
            'foto' => UploadedFile::fake()->image('foto.jpg'),
            'ijazah' => UploadedFile::fake()->create('ijazah.pdf', 100),
            'akta' => UploadedFile::fake()->create('akta.pdf', 100)
        ];

        $response = $this->actingAs($this->user)
                        ->post(route('formulir.update'), $data);

        $response->assertRedirect(route('formulir.show'));
        $response->assertSessionHas('success');
        Storage::disk('public')->assertExists('uploads/foto/' . $data['foto']->hashName());
    }

    public function test_update_status_changes_pendaftaran_status()
    {
        $request = new Request(['status' => 'diterima']);
        
        $response = $this->controller->updateStatus($request, $this->pendaftaran->id);
        
        $this->assertEquals('diterima', $this->pendaftaran->fresh()->status);
        $this->assertFalse($this->pendaftaran->fresh()->bisa_daftar_ulang);
    }

    public function test_update_status_handles_rejection()
    {
        $request = new Request(['status' => 'ditolak']);
        
        $response = $this->controller->updateStatus($request, $this->pendaftaran->id);
        
        $this->assertEquals('ditolak', $this->pendaftaran->fresh()->status);
        $this->assertTrue($this->pendaftaran->fresh()->bisa_daftar_ulang);
    }

    public function test_handle_jurusan_change_updates_quotas()
    {
        $oldJurusan = Jurusan::factory()->create(['kuota' => 0, 'penuh' => true]);
        $newJurusan = Jurusan::factory()->create(['kuota' => 1, 'penuh' => false]);
        
        $this->pendaftaran->update(['jurusan_id' => $oldJurusan->id]);
        
        $this->controller->handleJurusanChange($this->pendaftaran, $newJurusan->id);
        
        $this->assertEquals(1, $oldJurusan->fresh()->kuota);
        $this->assertEquals(0, $newJurusan->fresh()->kuota);
        $this->assertFalse($oldJurusan->fresh()->penuh);
        $this->assertTrue($newJurusan->fresh()->penuh);
    }
}

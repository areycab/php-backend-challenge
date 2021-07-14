<?php

namespace Tests\Feature;

use App\Experto;
use App\Hipoteca;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function testCrearSolicitudHipotecaNuevoCliente()
    {
        factory(Experto::class, 1)->create();
        $response = $this->post('api/hipotecas/crear',[
            'ahorros_aportados' => 30000,
            'precio_compra' => 100000,
            'nombre' => 'Antonio',
            'apellidos' => 'Rey',
            'email' => 'cabelloantonio92@gmail.com',
            'telefono' => '670000000'
        ]);
        $response->assertStatus(200);

        $this->assertEquals(1, $response['data']['id']);
        $this->assertEquals(1, $response['data']['experto_id']);
        $this->assertEquals(1, $response['data']['cliente_id']);
    }

    public function testCrearSolicitudHipotecaClienteExistente()
    {
        factory(Hipoteca::class, 1)->create();
        $hipoteca = Hipoteca::with('cliente')->find(1);
        $response = $this->post('api/hipotecas/crear',[
            'ahorros_aportados' => 30000,
            'precio_compra' => 100000,
            'nombre' => $hipoteca->cliente->nombre,
            'apellidos' => $hipoteca->cliente->apellidos,
            'email' => $hipoteca->cliente->email,
            'telefono' => $hipoteca->cliente->telefono
        ]);
        $response->assertStatus(200);

        $this->assertEquals(2, $response['data']['id']);
        $this->assertEquals(1, $response['data']['experto_id']);
        $this->assertEquals(1, $response['data']['cliente_id']);
        $this->assertEquals(2, Hipoteca::where('cliente_id', $response['data']['cliente_id'])->count());
    }

    public function testObtenerLasHipotecasDeUnExperto()
    {
        factory(Hipoteca::class, 20)->create();
        $hipoteca = Hipoteca::find(4);
        $response = $this->get('api/experto/hipotecas?experto_id='.$hipoteca->experto_id.'&fecha_solicitud='.$hipoteca->created_at->format('Y-m-d'));
        $response->assertStatus(200);
        $this->assertEquals(4, $response['data'][0]['id']);
    }

    public function testObtenerTodasLasHipotecas()
    {
        factory(Hipoteca::class, 20)->create();
        $response = $this->get('api/hipotecas');
        $response->assertStatus(200);
        $response->assertJsonCount(20, 'data');
    }

    public function testObtenerExpertoAleatorio()
    {
        factory(Experto::class, 5)->create();
        $response = $this->get('api/experto/aleatorio');
        $response->assertStatus(200);
        $this->assertNotNull($response['data']);
    }
}

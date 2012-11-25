<?php

use Succinct\Coil\Coil;

class Coil_Test extends PHPUnit_Framework_TestCase {

	public function testInstance() {
		$curl = new Coil();
        $this->assertInstanceOf('Succinct\Coil\Coil', $curl);
	}

    public function testPost() {
        $res = Coil::post('http://requestb.in/shggqfsh', array(
                'Hello' => 'World'
            ));
        $this->assertEquals(
            "ok\n", $res
            );
    }

}

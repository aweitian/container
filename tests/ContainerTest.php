<?php


class ContainerTest extends PHPUnit_Framework_TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testloadEnv()
    {
        $test = new Aw\Container();
        $test->single('single',function (){
            return new a();
        });
        $s = $test->make('single');
        $this->assertFalse($test->hasError);
        $this->assertEquals($s->lol(),'lol');
        $test->instance('ins','kkoo');
        $this->assertEquals('kkoo',$test->make('ins'));

        $test->single('single2',function (){
            return new b();
        });

        $s = $test->make('single2');
        $this->assertFalse($test->hasError);
        $this->assertEquals($s->lol(),1);


        $s = $test->make('single2');
        $this->assertEquals($s->lol(),2);


        $test->bind('b',function (){
            return new b();
        });

        $s = $test->make('b');
        $this->assertFalse($test->hasError);
        $this->assertEquals($s->lol(),1);


        $s = $test->make('b');
        $this->assertEquals($s->lol(),1);
     }
}

class a
{
    public function lol()
    {
        return 'lol';
    }
}
class b
{
    public $c = 0;
    public function lol()
    {
        $this->c++;
        return $this->c;
    }
}


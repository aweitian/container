<?php
class ContainerTest extends PHPUnit_Framework_TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMake()
    {
    	//$app = new \tian\container();
    	//$c = $app->make('c');
        //$this->assertTrue($c instanceof c, 'ok');
        //$this->assertInstanceOf("c", $c);
    }
    public function testBind()
    {
    	$app = new \Tian\Container();
    	$c = $app->bind('b', function($o) use ($app) {
    		$this->assertEquals($o, $app);
    		//这个地方不能用 return $app['b'];因为会递归解析这个B，没有退出条件
    		return $app->build("b");
    	});
    	$this->assertInstanceOf("b", $c['b']);
    }
    public function testInstance()
    {
    	$app = new \Tian\Container();
    	$c = $app->instance('gaga', 123);
    	$this->assertEquals(123, $c->make('gaga'));
    }
}
class a
{
	public function __construct(b $b)
	{
		$b->test();
	}
	public function test()
	{
		//echo 'a->test()'."\n";
	}

}
class b
{
	private $c;
	public function __construct($c=2)
	{
		$this->c = $c;
	}
	public function test()
	{
		//echo 'b->test():'.$this->c."\n";
	}

}
class c
{
	public function __construct(a $a)
	{
		$a->test();
	}
}


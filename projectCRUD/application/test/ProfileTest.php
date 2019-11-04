<?php 
use PHPUnit\Framework\TestCase;
final class ProfileTest extends TestCase
{
    public function testDisplayListPage()
    {
        $local = '127.0.0.1:8080';
        $response = $$local->get('/profile/list');
        $response->assertSee('List Page');
    }
}
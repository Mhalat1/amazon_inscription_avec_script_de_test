<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Register');
        $form = $crawler->selectButton('Sinscrire')->form([
            'registration_form[email]' => 'nouveau3@new.fr',
            'registration_form[username]' => 'new',
            'registration_form[plainPassword]' => '321654',
            'registration_form[isCommercant]' => false,
            'registration_form[agreeTerms]' => true,
        ]);

        $client->submit($form);

        $this->assertResponseRedirects('/article/');
        $client->followRedirect();
        // $this->assertSelectorTextContains('.table', 'Test Article');
    }
}
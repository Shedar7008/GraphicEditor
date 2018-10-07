<?php

namespace Shop\Tests\Module\User;

require __DIR__ . '/../../../includes.php';

use PHPUnit\Framework\TestCase;
use Shop\Core\DB;
use Shop\Module\Guest\Guest;
use Shop\Module\Guest\GuestRepository;

class RepositoryTest extends TestCase
{
    /** @var int */
    private $getByIDGuestID;

    /** @var int */
    private $addItemGuestID;

    /** @var int */
    private $deleteItemGuestID;

    protected function setUp()
    {
        $db = DB::getInstance();
        $db->query('insert into guest () values ()');
        $this->getByIDGuestID = $db->getInsertedID();

        $db->query('insert into guest () values ()');
        $this->deleteItemGuestID = $db->getInsertedID();
    }

    protected function tearDown()
    {
        $db = DB::getInstance();

        $sql = sprintf('delete from guest where ID=%d', $this->getByIDGuestID);
        $db->query($sql);

        if($this->addItemGuestID){
            $sql = sprintf('delete from guest where ID=%d', $this->addItemGuestID);
            $db->query($sql);
        }
    }

    /** @test */
    public function addItemTest()
    {
        $guest = new Guest();
        $guestRepository = GuestRepository::getInstance();
        $guestID = $guestRepository->addItem($guest);
        $this->assertTrue(!empty($guestID) && is_int($guestID));
        $this->addItemGuestID = $guestID;
    }

    /** @test */
    public function getByIDTest()
    {
        $guestRepository = GuestRepository::getInstance();
        $guest = $guestRepository->getByID($this->getByIDGuestID);
        $this->assertTrue($guest instanceof Guest);
    }

    /** @test */
    public function deleteItemTest()
    {
        $guestRepository = GuestRepository::getInstance();
        $deleteResult = $guestRepository->deleteItem($this->deleteItemGuestID);
        $this->assertTrue($deleteResult);
    }
}

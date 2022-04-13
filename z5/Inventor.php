<?php
require_once "MyPdo.php";
class Inventor
{
    /* @var MyPDO */
    protected $db;

    protected int $id;
    protected string $name;
    protected string $surname;
    protected string $image;
    protected DateTime $birth_date;
    protected string $birth_place;
    protected DateTime $death_date;
    protected string $death_place;
    protected string $description;

    public function __construct()
    {
        $this->db = MyPDO::instance();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getBirthDate(): DateTime
    {
        return $this->birth_date;
    }

    /**
     * @param string $birth_date
     */
    public function setBirthDate(string $birth_date): void
    {
        $this->birth_date = DateTime::createFromFormat('d.m.Y', $birth_date);
        //$this->birth_date = DateTime::createFromFormat('d.m.Y', $birth_date);
    }

    /**
     * @return string
     */
    public function getBirthPlace(): string
    {
        return $this->birth_place;
    }

    /**
     * @param string $birth_place
     */
    public function setBirthPlace(string $birth_place): void
    {
        $this->birth_place = $birth_place;
    }

    /**
     * @return DateTime
     */
    public function getDeathDate(): DateTime
    {
        return $this->death_date;
    }

    /**
     * @param DateTime $death_date
     */
    public function setDeathDate(string $death_date): void
    {
        if($death_date) {
            $this->death_date = DateTime::createFromFormat('d.m.Y', $death_date);
            //$this->death_date = DateTime::createFromFormat('d.m.Y', $death_date);
        }
    }

    /**
     * @return string
     */
    public function getDeathPlace(): string
    {
        return $this->death_place;
    }

    /**
     * @param string $death_place
     */
    public function setDeathPlace(string $death_place): void
    {
        $this->death_place = $death_place;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public static function all() {

        return MyPDO::instance()->run("SELECT * FROM inventors ")->fetchAll();
    }

    public static function searchByDescription($description)
    {
        $data = MyPDO::instance()->run("SELECT * FROM inventors WHERE description = ?", [$description])->fetch();
        if (!$data) {
            return false;
        }
        $user = new Inventor();
        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->image = $data['image'];
        $user->description = $data['description'];
        $user->birth_date = DateTime::createFromFormat('Y-m-d', $data['birth_date']);
        $user->birth_place = $data['birth_place'];
        $user->death_date = DateTime::createFromFormat('Y-m-d', $data['death_date']);
        $user->death_place = $data['death_place'];
        return $user;
    }


    public static function find($id)
    {
        $data = MyPDO::instance()->run("SELECT * FROM inventors WHERE id = ?", [$id])->fetch();
        if (!$data) {
            return false;
        }

        $user = new Inventor();
        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->image = $data['image'];
        $user->description = $data['description'];
        $user->birth_date = DateTime::createFromFormat('Y-m-d', $data['birth_date']);
        $user->birth_place = $data['birth_place'];
        $user->death_date = DateTime::createFromFormat('Y-m-d', $data['death_date']);
        $user->death_place = $data['death_place'];
        return $user;

    }

    public function destroy()
    {
        MyPDO::instance()->run("delete from inventors where id = ?",
            [$this->id]);
        unset($this->id);
        return true;
    }

    public function save()
    {
        $this->db->run("INSERT into inventors 
            (`name`, `surname`, `image`,`birth_date`, `birth_place`, `death_date`, `death_place`,`description`) values (?, ?, ?, ?, ?, ?, ?, ?)",
            [$this->name, $this->surname, $this->image, $this->birth_date->format('Y-m-d'), $this->birth_place,
                isset($this->death_date) ? $this->death_date->format('Y-m-d') : null, $this->death_place, $this->description]);
        $this->id = $this->db->lastInsertId();
    }

    public function toArray()
    {
        return ['id' => $this->id, 'name' => $this->name, 'surname' => $this->surname, 'image' => $this->image, 'description' => $this->description, 'birth_date'=> $this->birth_date, 'birth_place' => $this->birth_place, 'death_date'=> $this->death_date, 'death_place' => $this->death_place];
    }
}
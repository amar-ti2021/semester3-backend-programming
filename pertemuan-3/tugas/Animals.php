<?php

# membuat class Animal
class Animal
{
    # property animals
    private $animals;
    # method constructor - mengisi data awal
    # parameter: data hewan (array)
    public function __construct($data = [])
    {
        if(!is_array($data)) {
            echo "harap masukkan array";
            return;
        }
        $this->animals = $data;
    }

    # method index - menampilkan data animals
    public function index()
    {
        # gunakan foreach untuk menampilkan data animals (array)
        $idx = 0;
        foreach($this->animals as $animal){
            echo "[". $idx . "] " . $animal ."<br>";
            $idx++;
        }
    }

    # method store - menambahkan hewan baru
    # parameter: hewan baru
    public function store($data)
    {
        # gunakan method array_push untuk menambahkan data baru
        $this->cekData($data);
        array_push($this->animals, $data);
    }

    # method update - mengupdate hewan
    # parameter: index dan hewan baru
    public function update($index, $data)
    {
        $this->cekIdx($index);
        $this->cekData($data);
        $this->animals[$index] = $data;
    }

    # method delete - menghapus hewan
    # parameter: index
    public function destroy($index)
    {
        $this->cekIdx($index);
        unset($this->animals[$index]);
        # gunakan method unset atau array_splice untuk menghapus data array
    }
    public function cekData($data){
        if(!is_string($data)) {
            echo "harap masukkan string <br>";
            return;
        }
    }
    public function cekIdx($idx){
        if(!is_integer($idx) || $idx < 0 || $idx > sizeOf($this->animals) - 1) {
            echo "index salah <br>";
            return;
        }
    }
}

# membuat object
# kirimkan data hewan (array) ke constructor
$animal = new Animal([]);

echo "Index - Menampilkan seluruh hewan <br>";
$animal->index();
echo "<br>";

echo "Store - Menambahkan hewan baru <br>";
$animal->store('burung');
$animal->index();
echo "<br>";

echo "Store - Menambahkan hewan baru <br>";
$animal->store('burung');
$animal->index();
echo "<br>";

echo "Update - Mengupdate hewan <br>";
$animal->update(0, 'Kucing Anggora');
$animal->index();
echo "<br>";

echo "Destroy - Menghapus hewan <br>";
$animal->destroy(1);
$animal->index();
echo "<br>";

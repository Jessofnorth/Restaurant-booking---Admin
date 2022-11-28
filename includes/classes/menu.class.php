<?php
/* @author Jessica Ejelöv - jeej2100@student.miun.se */

class Menu
{
    // properties
    private $name;
    private $price;
    private $category;
    private $info;
// get menu from API
    public function getMenu(): array
    {
        $url = 'https://studenter.miun.se/~jeej2100/writeable/johansAPI/menu.php';

        // curl with GET
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //result
        $data = json_decode(curl_exec($curl), true);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if ($httpcode === 404) {
            $data = array("message" => "Det finns ingen meny.");
        }
        return $data;
    }
// get menu by category added to URL from API
    public function getMenuByCategory(string $category): array
    {
        $url = "https://studenter.miun.se/~jeej2100/writeable/johansAPI/menu.php?category=$category";
        // curl with POST
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //result
        $data = json_decode(curl_exec($curl), true);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if ($httpcode === 404) {
            $data = array("message" => "Det finns ingen meny.");
        }elseif($httpcode === 500){
            $data = array("message" => "Det finns ingen meny.");
        }
        return $data;
    }
// add dish to API database
    public function addDish(): bool
    {
        $url = 'https://studenter.miun.se/~jeej2100/writeable/johansAPI/menu.php';

        // curl with POST
        $curl = curl_init();
        $dish = array("name" => $this->name, "price" => $this->price, "category" => $this->category, "info" => $this->info);
        //convert to JSON
        $json_string = json_encode($dish);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $json_string);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //result
        $data = json_decode(curl_exec($curl), true);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if ($httpcode === 201) {
            return true;
        } else {
            return false;
        }
    }

    // set methods
    public function setName(string $name): bool
    { // set NAME and check input
        $name = trim($name);
        if ($name != "") {
            $name = strip_tags($name);
            $this->name = $name;
            return true;
        } else {
            return false;
        }
    }
    public function setPrice(int $price): bool
    { // set PRICE and check input
        $price = trim($price);
        if ($price != "") {
            $price = strip_tags($price);
            $this->price = $price;
            return true;
        } else {
            return false;
        }
    }
    public function setCategory(string $category): bool
    { // set CATEGORY and check input 
        $category = trim($category);
        if ($category != "") {
            $category = strip_tags($category);
            $this->category = $category;
            return true;
        } else {
            return false;
        }
    }
    public function setInfo(string $info): bool
    { // Set INFO and check input 
        $info = trim($info);
        if ($info != "") {
            $info = strip_tags($info);
            $this->info = $info;
            return true;
        } else {
            return false;
        }
    }
}

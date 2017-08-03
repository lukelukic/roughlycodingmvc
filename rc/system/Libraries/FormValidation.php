<?php

namespace rc\system\Libraries;

/*
    Biblioteka za validaciju podataka dobijenih iz forme.

    Sadrzi privatni niz cestih regularnih izraza, na osnovu kog se vrsi validacija elemenata forme.

    Javni metodi :

    checkCommon(type, value, errorMessage) - ocekuje tip regularnog izraza koji se nalazi u nizu,
        vrednost koju treba validirati i poruku koja se upisuje u validationErrors ako regex nije uspeo

    checkRegex(regex,value,errorMessage) - isto kao iznad, samo sa custom regexom

    checkCommonBatch(array) - niz regularnih za koje se poziva funkcija checkCommon

    isValid() - provera da li postoje error-i

    getErrorMessages() - vraca se niz error-a nastalih pri validaciji

 */
class FormValidation
{
    private $regexes = array(
      'email' => "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",
      'username' =>  "/^[A-z][A-z\_\-0-9\.]{2,20}$/",
      'password' => "/^(?=.*[0-9])(?=.*[a-z])(\S+)$/i",
      'url' => "^(?:https?://)?(?:[a-z0-9-]+\.)*((?:[a-z0-9-]+\.)[a-z]+)",
      'ip' => '/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/',
      'name' => "/^[\p{Lu}[\p{Ll}]{1,15}$/u",
      'image' => "/^.*\.(jpg|jpeg|png|gif)$/",
      'fullName' => '/^[A-Z][a-z]{3,15}(\s[A-Z][a-z]{3,15})*$/',
      'phone' => '/^(\+\d{1,3}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{3,4}$/'
      );
    private $validationErrors = array();
    private $valid = true;

    public function __construct()
    {
    }

    //Proverava validnost vrednosti iz niza postojecih, na osnovu vrednosti
    //Ukoliko dodje do greske, u polje validationErrors upisuje prosledjeni errorMessage
    public function checkCommon($type, $value, $errorMessage)
    {
        switch ($type) {
          case 'phone':
              if (!preg_match($this->regexes['phone'], $value)) {
                  array_push($this->validationErrors, $errorMessage);
              }
              break;
            case 'name':
                if (!preg_match($this->regexes['name'], $value)) {
                    array_push($this->validationErrors, $errorMessage);
                }
                break;
            case 'fullName':
                if (!preg_match($this->regexes['fullName'], $value)) {
                    array_push($this->validationErrors, $errorMessage);
                }
                break;
            case 'image':
                if (!preg_match($this->regexes['image'], $value)) {
                    array_push($this->validationErrors, $errorMessage);
                }
                break;
            case 'email':
                 if (!preg_match($this->regexes['email'], $value)) {
                     array_push($this->validationErrors, $errorMessage);
                 }
                break;
            case 'username':
                if (!preg_match($this->regexes['username'], $value)) {
                    array_push($this->validationErrors, $errorMessage);
                }
                break;
            case 'password':
                if (!preg_match($this->regexes['password'], $value)) {
                    array_push($this->validationErrors, $errorMessage);
                }
                break;
            case 'url':
                if (!preg_match($this->regexes['url'], $value)) {
                    array_push($this->validationErrors, $errorMessage);
                }
                break;
            case 'ip':
                if (!preg_match($this->regexes['ip'], $value)) {
                    array_push($this->validationErrors, $errorMessage);
                }
                break;
            default:
                break;
      }
    }
    //Validacija vrednosti na osnovu prosledjenog regexa
    //Ukoliko vrednost ne prodje, errorMessage se dodaje u niz validationErrors
    public function checkRegex($regex, $value, $errorMessage)
    {
        if (!preg_match($regex, $value)) {
            array_push($this->validationErrors, $errorMessage);
        }
    }
    //Vraca true ili false u zavisnosti od toga da li su prosledjeni podaci validni ili ne
    public function isValid()
    {
        return count($this->validationErrors) == 0;
    }
    //Vraca sve trenutne errore
    public function getErrorMessages()
    {
        return $this->validationErrors;
    }
    //Cisti niz validationErrors
    public function clearErrors()
    {
        $this->validationErrors = array();
    }

    //Proverava vise vrednost, na osnovu postojecih regularnih izraza, moguca je i required obrada
    public function checkCommonBatch($inputs)
    {
        foreach ($inputs as $input) {
            if (isset($input['required'])) {
                if ($input['value']!="") {
                    $this->checkCommon($input['type'], $input['value'], $input['message']);
                } else {
                    array_push($this->validationErrors, $input["name"] . " field is required.");
                }
            } else {
                $this->checkCommon($input['type'], $input['value'], $input['message']);
            }
        }
    }
}

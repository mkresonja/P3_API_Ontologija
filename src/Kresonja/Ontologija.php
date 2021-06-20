<?php
namespace Kresonja;

/**
 * @Entity @Table(name="ontologija")
 **/


class Ontologija
{
    /** @Id @Column(type="integer") @GeneratedValue  **/
    protected $sifra;

    /** @Column(type="string") **/
    private $autor;

    /** @Column(type="string") **/
	private $izdavac;
	
    /** @Column(type="string") **/
	private $naslov;
	
    /** @Column(type="string") **/
	private $zanr;
	
    /** @Column(type="integer") **/
	private $brojStranica;
	
    /** @Column(type="integer") **/
	private $jeIzdana;
	


	public function getSifra()
	{
		return $this->sifra;
	}

	public function setSifra($sifra)
	{
		$this->sifra = $sifra;
	}


	public function getAutor()
	{
		return $this->autor;
	}

	public function setAutor($autor)
	{
		$this->autor = $autor;
	}


	public function getIzdavac()
	{
		return $this->izdavac;
	}

	public function setIzdavac($izdavac)
	{
		$this->izdavac = $izdavac;
	}


	public function getNaslov()
	{
		return $this->naslov;
	}

	public function setNaslov($naslov)
	{
		$this->naslov = $naslov;
	}


	public function getZanr()
	{
		return $this->zanr;
	}

	public function setZanr($zanr)
	{
		$this->zanr = $zanr;
	}


	public function getBrojStranica()
	{
		return $this->brojStranica;
	}

	public function setBrojStranica($brojStranica)
	{
		$this->brojStranica = $brojStranica;
	}


	public function getJeIzdana()
	{
		return $this->jeIzdana;
	}

	public function setJeIzdana($jeIzdana)
	{
		$this->jeIzdana = $jeIzdana;
	}



    public function setPodaci($podaci)
    {
      foreach($podaci as $kljuc => $vrijednost){
        $this->{$kljuc} = $vrijednost;
      }
    }

}
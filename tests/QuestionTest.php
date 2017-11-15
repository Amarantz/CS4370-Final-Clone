<?php

class QuestionTest extends \PHPUnit_Framework_TestCase
{
    public function testQuestionSubject()
    {
        //arrange
        $expect  = "This is a QuestionEloquentModel";
        //act
        $q = new \App\Domain\Question();
        $q->setQuestion("This is a QuestionEloquentModel");
        //assert

        $this->assertTrue(!empty($q->getUuid()));
        $this->assertEquals($expect,$q->getQuestion());
    }

    public function testQuestionSubjectFail()
    {
        //arrange
        $expect  = "This is a QuestionEloquentModel";
        //act
        $q = new \App\Domain\Question();
        $q->setQuestion("Some Other question");
        //assert

        $this->assertNotEquals($expect,$q->getQuestion());
    }

    public function testQuestionDetails()
    {
        //arrange
        $expect = "this is the body";

        //act
        $q = new \App\Domain\Question();
        $q->setBody("this is the body");

        //assert
        $this->assertEquals($expect, $q->getBody());
    }

    public function testQuestionDetailsFails()
    {
        //arrange
        $expect = "this is the body";

        //act
        $q = new \App\Domain\Question();
        $q->setBody("this is the body 222");

        //assert
        $this->assertNotEquals($expect, $q->getBody());
    }

    public function testQuestionBodyEmptyArgumentsException()
    {
        // arrange
        $actual = null;
        $expected = "Not a valid Argument";
        // act
        try {
            $q = new \App\Domain\Question();
            $q->setBody("");
        } catch(\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        // assert
        $this->assertEquals($expected, $actual);
    }
    public function testQuestionSubjectEmptyArgumentsException()
    {
        // arrange
        $actual = null;
        $expected = "Not a valid Argument";
        // act
        try {
            $q = new \App\Domain\Question();
            $q->setQuestion("");
        } catch(\Exception $e) {
            $actual = $e->getMessage();
            $this->assertEquals(\InvalidArgumentException::class, get_class($e));
        }
        // assert
        $this->assertEquals($expected, $actual);
    }

    public function testQuestionLength()
    {
	    // arrange
	    $actual = null;
	    $expected = "QuestionEloquentModel length is to long";
	    //act 
	    try {
		    $q = new \App\Domain\Question();
		    $q->setQuestion("This is a very long string of charecters we are making sure when get an exception for the number of random charecters. 11234561231231231212314512312312312351231231235123123512312351231235123123512312354123124123512312351231235123123512312314125123123512312315123123512312351231235123123512312354123123541231254123512");

	    } catch(\Exception $e) {
		    $actual = $e->getMessage();
		    $this->assertEquals(\InvalidArgumentException::class, get_class($e));
	    }
	    $this->assertEquals($expected, $actual);
    }


    public function testQuestionBodyLegth()
    {
	    //arragne
	    $actual = null;
	    $expected = "QuestionEloquentModel body is to long";
	    //act
	    try {
		    $q = new \App\Domain\Question();
		    $q->setBody("adfadfadfadfadsfjkal;dfjkl;adfjkla;dfjkl;asdjflk;adjfkl;asdfjkla;sfjklas;dfjkl;asfj;klasdfj;lasdjfk;lasdjfkl;asjdfkl;adjkfl;ajfdkl;ajfkl;adjfkl;adfja;
		    ajdkfl;ajkdlf;ajkdfl;ajsdkfl;ajsdkfl;ajdsfkl;adjfkl;adjfkl;adfjkl;adfjkl;adfjkl;asdfjkl;adfjkl;asdjfkl;adfjkl;dfjkl;adjfkl;adfjkla;fjkadjfk;lafj;lafjkl;ajdfkl;afj
		    adfjkla;djfkl;asf jkl;dajkl;adshjfk;olasdjfkl;dsjfl;asdjfkl;djfl;kadfkla;sfhksad;fhjkasl;dfjkals;fjkl;asfjkl;asdfjkl;asdjflk;asdflk;asdfkl;djkl;ajkas;kl;sfhkdnf;alsdfkajdsfklajdfkl;ajfdkl;asd
		    tekal;jfdklajfkdl;ajfkl;dajfkl;ai;lzjkc;jkdjkfl;jfdkl;adjfl;kasjdfkl;afjk;lajfk;lda;l;adfkl;adjfkl;ajdfk;lajkl;jkgl;jkl;l;ajdkflak;dfklasdfjk;ladfjkl;adfk;jkl;jkl;;adfjkl;adfjkl;afdkjl;ajkdf;l
			jkdlfajkl;dajskfl;jakdsfjlka;dsfjk;ladjfk;ljdktg;jdaks;fjkl;dasfjkl;asdfjkl;adfjkl;adsjtk;lasjdfkl;adjfkl;adjfkl;adjfkl;adnkl;thjdkfjkl;ajklf;dajfkl;adfjkl;asdjfkl;asdfjkadsfjk;adfjk;jaskdf;al
			dsfjkl;adjfl;asdjfkl;ajtl/zt;yadjkl;afdk;lal;ksdfjkl;adfhki;adshfkj;asjhfkl;asfjksla;dfjkl;sadfjkl;sadjfkl;dfkhkadsl;htkasdrjtkl;ajfdlk;jdkl;jfk;ladfjk;ladfhkl;afhkds;afjk;lafjka;sthkd;ajf;da;");
	
	    } catch (\Exception $e) {
		    $actual = $e->getMessage();
		    $this->assertEquals(\InvalidArgumentException::class, get_class($e));
	    }
	    $this->assertEquals($expected,$actual);
    }

    public function testQuestionUser()
    {
	//arrange
	$u = new \App\Domain\User('some@email.com','Pass1234');
	$q = new \App\Domain\Question();
	$expected = 'some@email.com';
	//act
	$q->setUser($u);
	$actual = $q->getUser();
	//assert
	$this->assertEquals($expected,$actual->getEmail());

    }
    public function testQuestionNumber()
    {
	//arragne
	$expect = "Argument is not a string";
	$actual = null;
	//act
	try {
		$q = new \App\Domain\Question();
		$q->setQuestion(1);
	} catch (\Exception $e) {
		$actual = $e->getMessage();
		$this->assertEquals(\InvalidArgumentException::class, get_class($e));
	}
	$this->assertEquals($expect,$actual);
    }
    public function testQuestionBodyNumber()
    {
	//arragne
	$expect = "Argument is not a string";
	$actual = null;
	//act
	try {
		$q = new \App\Domain\Question();
		$q->setBody(1);
	} catch (\Exception $e) {
		$actual = $e->getMessage();
		$this->assertEquals(\InvalidArgumentException::class, get_class($e));
	}
	$this->assertEquals($expect,$actual);
    }
}

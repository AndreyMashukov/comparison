<?php

namespace AdService;

class Comparison
    {

	/**
	 * Percent
	 *
	 * @var int Persent of comparison
	 */
	public $percent;

	/**
	 * Match
	 *
	 * @var bool Strings match
	 */
	public $match;

	/**
	 * Construct class
	 *
	 * @param string $a First string
	 * @param string $b Second string
	 *
	 * @return void
	 */

	public function __construct(string $a, string $b)
	    {
		$this->percent = $this->_compare(mb_strtoupper($a), mb_strtoupper($b));
		$this->match   = $this->_match($a, $b);
	    } //end __construct()


	/**
	 * Compare strings
	 *
	 * @param string $a First string
	 * @param string $b Second string
	 *
	 * @retutn int Result of compare
	 */

	private function _compare(string $a, string $b):int
	    {
		if (mb_strlen($a) >= mb_strlen($b))
		    {
			$first  = $a;
			$second = $b;
		    }
		else
		    {
			$first  = $b;
			$second = $a;
		    }

		$expla = $this->_strSplitUnicode($first, 1);
		$explb = $this->_strSplitUnicode($second, 1);

		$result = 0;
		$n = 0;
		foreach ($expla as $a)
		    {
			foreach ($explb as $key => $b)
			    {
				if ($b === $a)
				    {
					$n++;
					unset($explb[$key]);
				    } //end if

			    } //end foreach

		    } //end foreach

		if (count($expla) === 0)
		    {
			$result1 = 0;
		    }
		else
		    {
			$result1 = (100 * $n) / count($expla);
		    } //end if

		$expla = explode(" ", $first);
		$explb = explode(" ", $second);

		$result = 0;
		$n = 0;
		foreach ($expla as $a)
		    {
			foreach ($explb as $key => $b)
			    {
				if ($b === $a)
				    {
					$n++;
					unset($explb[$key]);
				    } //end if

			    } //end foreach

		    } //end foreach

		$result2 = (100 * $n) / count($expla);

		$result = ($result1 + $result2) / 2;

		return (int) ceil($result);
	    } //end _compare()


	/**
	 * Match strings
	 *
	 * @param string $a First string
	 * @param string $b Second string
	 *
	 * @retutn bool Result of match
	 */

	private function _match(string $a, string $b):bool
	    {
		if (mb_strlen($a) >= mb_strlen($b))
		    {
			$first  = $a;
			$second = $b;
		    }
		else
		    {
			$first  = $b;
			$second = $a;
		    }

		$match   = false;
		$seconds = preg_split("/[- .,]/", $second);

		foreach ($seconds as $second)
		    {
			if (mb_strlen($second) >= 4)
			    {
				@$match = ((preg_match("/" . mb_ereg_replace("/", "\/", $second) . "/ui", $first) > 0) ? true : false);
				if ($match === true)
				    {
					break;
				    } //end if

			    } //end if

		    } //end foreach

		return $match;
	    } //end _match()


	/**
	 * Split string
	 *
	 * @param string $str String to split
	 * @param int    $l   Split length
	 *
	 * @return string Result
	 */

	private function _strSplitUnicode($str, $l = 0)
	    {
		if ($l > 0)
		    {
			$ret = array();
			$len = mb_strlen($str, "UTF-8");
			for ($i = 0; $i < $len; $i += $l)
			    {
				$ret[] = mb_substr($str, $i, $l, "UTF-8");
			    }
			return $ret;
		    }

		return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
	    } //end _strSplitUnicode()


    } //end class

?>

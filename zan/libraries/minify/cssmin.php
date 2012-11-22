<?php
	
	class CSSMin
	{
		  // -- Public Static Methods --------------------------------------------------

		  /**
		* Minify Javascript
		*
		* @uses __construct()
		* @uses min()
		* @param string $js Javascript to be minified
		* @return string
		*/
		public static function minify($css) {
		    $cssmin = new CSSMin;
			return $cssmin->_optimize($css);
		}

		/**
		* Optimize
		* Optimize the contents of a css file
		* based on Drupal 7 CSS Core aggregator
		*
		* @param string $contents
		* @return string
		*/
		protected function _optimize($contents) {
			// Perform some safe CSS optimizations.
			// Regexp to match comment blocks.
			$comment = '/\*[^*]*\*+(?:[^/*][^*]*\*+)*/';
			// Regexp to match double quoted strings.
			$double_quot = '"[^"\\\\]*(?:\\\\.[^"\\\\]*)*"';
			// Regexp to match single quoted strings.
			$single_quot = "'[^'\\\\]*(?:\\\\.[^'\\\\]*)*'";
			// Strip all comment blocks, but keep double/single quoted strings.
			$contents = preg_replace(
				"<($double_quot|$single_quot)|$comment>Ss",
				"$1",
				$contents
			);
			// Remove certain whitespace.
			// There are different conditions for removing leading and trailing
			// whitespace.
			// @see http://php.net/manual/en/regexp.reference.subpatterns.php
			$contents = preg_replace_callback(
				'<' .
				# Strip leading and trailing whitespace.
				'\s*([@{};,])\s*' .
				# Strip only leading whitespace from:
				# - Closing parenthesis: Retain "@media (bar) and foo".
				'| \s+([\)])' .
				# Strip only trailing whitespace from:
				# - Opening parenthesis: Retain "@media (bar) and foo".
				# - Colon: Retain :pseudo-selectors.
				'| ([\(:])\s+' .
				'>xS',
				array('CSSMin', '_optimize_call_back'),
				$contents
			);

			return $contents;
		}

		// ------------------------------------------------------------------------

		/**
		* Optimize CB
		* Optimize Callback Helper companion for optimize fn
		* based on Drupal 7 CSS Core aggregator
		*
		* @param string $matches
		* @return array
		*/
		protected function _optimize_call_back($matches)
		{
			// Discard the full match.
			unset($matches[0]);

			// Use the non-empty match.
			return current(array_filter($matches));
		}
	}
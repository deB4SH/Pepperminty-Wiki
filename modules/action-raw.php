<?php
register_module([
	"name" => "Raw page source",
	"version" => "0.5",
	"author" => "Starbeamrainbowlabs",
	"description" => "Adds a 'raw' action that shows you the raw source of a page.",
	"id" => "action-raw",
	"code" => function() {
		global $settings;
		
		add_action("raw", function() {
			global $env;

			http_response_code(307);
			header("x-filename: " . rawurlencode($env->page) . ".md");
			header("content-type: text/markdown");
			exit(file_get_contents("$env->storage_prefix$env->page.md"));
			exit();
		});
		
		add_help_section("800-raw-page-content", "Viewing Raw Page Content", "<p>Although you can use the edit page to view a page's source, you can also ask $settings->sitename to send you the raw page source and nothing else. This feature is intented for those who want to automate their interaction with $settings->sitename.</p>
		<p>To use this feature, navigate to the page for which you want to see the source, and then alter the <code>action</code> parameter in the url's query string to be <code>raw</code>. If the <code>action</code> parameter doesn't exist, add it. Note that when used on an file's page this action will return the source of the description and not the file itself.</p>");
	}
]);

?>

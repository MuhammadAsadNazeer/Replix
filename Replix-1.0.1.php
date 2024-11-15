<?php
$version = 1.0;
/***********************************************************************
 * @name  Replix 
 * @author Muhammad Asad Nazeer
 * @abstract Search and Replace Multiple queries text in files and folders within a specified directory.
 * @version 1.0.1
 * @company Hedows Technologies
 * @website https://hedows.com/
 * @package 
 *************************************************************************/
function sanitize($text) {
    $temp = $text;
    $text = sanitize_core($text);
    $text = str_replace('&amp;', '&', $text);
	$search = "/((?#Email)(?:\S+\@)?(?#Protocol)(?:(?:ht|f)tp(?:s?)\:\/\/|~\/|\/)?(?#Username:Password)(?:\w+:\w+@)?(?#Subdomains)(?:(?:[-\w]+\.)+(?#TopLevel Domains)(?:com|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum|travel|a[cdefgilmnoqrstuwz]|b[abdefghijmnorstvwyz]|c[acdfghiklmnoruvxyz]|d[ejkmnoz]|e[ceghrst]|f[ijkmnor]|g[abdefghilmnpqrstuwy]|h[kmnrtu]|i[delmnoqrst]|j[emop]|k[eghimnprwyz]|l[abcikrstuvy]|m[acdghklmnopqrstuvwxyz]|n[acefgilopruz]|om|p[aefghklmnrstwy]|qa|r[eouw]|s[abcdeghijklmnortuvyz]|t[cdfghjkmnoprtvwz]|u[augkmsyz]|v[aceginu]|w[fs]|y[etu]|z[amw]|aero|arpa|biz|com|coop|edu|info|int|gov|mil|museum|name|net|org|pro))(?#Port)(?::[\d]{1,5})?(?#Directories)(?:(?:(?:\/(?:[-\w~!$+|.,=]|%[a-f\d]{2})+)+|\/)+|#)?(?#Query)(?:(?:\?(?:[-\w~!$+|\/.,*:]|%[a-f\d{2}])+=?(?:[-\w~!$+|.,*:=]|%[a-f\d]{2})*)(?:&(?:[-\w~!$+|.,*:]|%[a-f\d{2}])+=?(?:[-\w~!$+|.,*:=]|%[a-f\d]{2})*)*)*(?#Anchor)(?:#(?:[-\w~!$+|\/.,*:=]|%[a-f\d]{2})*)?)([^[:alpha:]]|\?)/i";
    return trim($text);
}
function sanitize_core($text) {
    $text = htmlspecialchars($text, ENT_NOQUOTES);
    $text = str_replace("\n\r", "\n", $text);
    $text = str_replace("\r\n", "\n", $text);
    $text = str_replace("\n", " <br> ", $text);
    return trim($text);
}
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'getFileContent' && isset($_REQUEST['filePath'])) {
    echo sanitize(file_get_contents($_REQUEST['filePath']));
    exit;
}
session_start();
?>
<title>Search and Replace | Replix 1.0.1</title>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Search and Replace | Replix</title>
	<link rel="stylesheet" href="styles.css">
 <!-- Font Awesome CDN for social media icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>
<a href="https://hedows.com/portfolio/Replix/"><h1>Replix - Search and Replace</h1></a>

<!-- Social Media Icons and Donation Button Section -->
<div class="social-media-and-donate">
    <div class="social-media-icons">
        <a href="https://www.facebook.com/HedowsTechnologies/" target="_blank" class="icon facebook"><i class="fab fa-facebook-square"></i></a>
        <a href="https://x.com/hedows" target="_blank" class="icon twitter"><i class="fab fa-twitter-square"></i></a>
        <a href="https://pk.linkedin.com/company/hedows" target="_blank" class="icon linkedin"><i class="fab fa-linkedin"></i></a>
        <a href="https://www.instagram.com/hedowstechnologies/" target="_blank" class="icon instagram"><i class="fab fa-instagram"></i></a>
        <a href="https://www.youtube.com/@HedowsTechnologies" target="_blank" class="icon youtube"><i class="fab fa-youtube"></i></a>
    </div>
    
    <!-- Big Donation Button -->
    <div class="donation-button">
        <a href="https://hedows.com/Donate-Now/">
            <button class="big-donation-btn">Donate Now</button>
        </a>
    </div>
</div>


<div class="Replix-form">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="searchForum" enctype="multipart/form-data">  
    <table>
        <tbody>
			<tr>
				<td>
					<input type="checkbox" name="case" checked /><label for="case">Case Sensitive </label>
					<input type="checkbox" name="content" checked /> <label for="content">Search Content </label>
					<input type="checkbox" name="occurrences" checked /> <label for="occurrences">Count Occurrences </label>
					<input type="checkbox" name="showLabel" checked /> <label for="showLabel">Show Label </label></br>
				</td>
            </tr>
			<tr>
                <td>
					<label for="directory">Directory </label>
					<input id="directory" type="text" name="directory" value="<?php echo getcwd() . DIRECTORY_SEPARATOR . 'Replace'; ?>" />
				</td>
            </tr>
            <tr>
                <td>
					<label for="type">File Type</label> <span>(txt,php,css)</span>
					<input id="type" type="text" name="type" value="txt,po,mo,xml,html,css,scss,less,php,phtml,js,json,jsp,asp" />
            </tr>
            <tr>
                <td>
					<label for="maxtime">Max Execution Time </label> <span> (Seconds)</span>
					<input type="text" name="maxtime" value="30"/>
				</td>
            </tr>
            <tr>
                <td id="searchReplacePairs">
					<label for="searchReplacePairs">Search and Replace Pairs</label>
					 <div class="search-replace-pair">
                        <input type="text" class="search" placeholder="Search" />
                        <input type="text" class="replace" placeholder="Replace" />
                        <button type="button" onclick="removePair(this)">Remove</button>
                    </div>
				</td>
                <td>
					<button id="add" type="button" onclick="addPair()">Add More</button> 
                </td>
            </tr>
            <tr>
                <td>
					<label for="importFile">Import Queries</label> <span>(.JSON)</span>
					<input type="file" id="importFile" name="importFile" />
				</td>
                <td>
					<button type="button" onclick="exportSearchReplace()">Export Queries</button>
				</td>
            </tr>
            <input type="hidden" name="searchReplacePairs" id="searchReplacePairsHidden" />
            <tr>
                <td><input type="button" onclick="submit_form();" value="Search and Replace" /></td>
            </tr>
        </tbody>
    </table>
</form>

<?php
$count = 0; // This variable will hold the total count of replacements
$totals = []; // Store total replacements per search term

// Handle file upload (import)
if (isset($_FILES['importFile']) && $_FILES['importFile']['error'] == 0) {
    $fileContent = file_get_contents($_FILES['importFile']['tmp_name']);
    $searchReplacePairs = json_decode($fileContent, true);
    if (json_last_error() === JSON_ERROR_NONE && is_array($searchReplacePairs)) {
        $_POST['searchReplacePairs'] = json_encode($searchReplacePairs);
    } else {
        echo "Error: Invalid JSON file.";
    }
}

function getDirContents($dir) {
    global $count, $totals;

    // Decoding search and replace pairs
    $searchReplacePairs = json_decode($_POST['searchReplacePairs'], true);
    ini_set('max_execution_time', $_POST['maxtime']); // Set max execution time
    $caseSensitive = isset($_POST['case']); // Check if case sensitivity is on
    $types = isset($_POST['type']) ? explode(',', str_replace(' ', '', $_POST['type'])) : []; // Supported file types
    $files = scandir($dir); // Scan directory for files

    // Ensure the Replace folder exists
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    foreach ($files as $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            $fileName = basename($path);
            $content = file_get_contents($path);
            $originalContent = $content;
            $fileReplacementsInFile = 0;  // Track replacements in this file

            // Process each search-replace pair
            foreach ($searchReplacePairs as $pair) {
                $searchTerm = $caseSensitive ? $pair['search'] : strtolower($pair['search']);
                $contentToSearch = $caseSensitive ? $content : strtolower($content);

                // If the file matches the search term and is of the correct type
                if ((!$types || in_array(pathinfo($fileName, PATHINFO_EXTENSION), $types)) && strpos($contentToSearch, $searchTerm) !== false) {
                    // Count replacements
                    $replacementCount = substr_count($contentToSearch, $searchTerm);
                    $fileReplacementsInFile += $replacementCount;

                    // Add the count to the global total for this search term
                    if (isset($totals[$pair['search']])) {
                        $totals[$pair['search']]['count'] += $replacementCount;
                    } else {
                        $totals[$pair['search']] = [
                            'count' => $replacementCount,
                            'replace' => $pair['replace']
                        ];
                    }

                    // Replace the content in the file
                    $content = str_replace($pair['search'], $pair['replace'], $content);
                }
            }

            // If there were replacements, update the file
            if ($fileReplacementsInFile > 0) {
                file_put_contents($path, $content);
            }

            // Add the number of replacements for this file to the global total
            $count += $fileReplacementsInFile;
        } else if ($value != "." && $value != "..") {
            // Recurse into subdirectories
            getDirContents($path);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['searchReplacePairs'])) {
    $dir = isset($_POST['directory']) ? $_POST['directory'] : getcwd();
    getDirContents($dir);

    // Output the total replacements per term after all files have been processed
    if ($totals) {
        foreach ($totals as $searchTerm => $data) {
            // Display both the search term and the replacement term
            echo "<strong>{$data['count']}</strong> <span>Total replacements of '<strong>{$searchTerm}</strong>' into '<strong>{$data['replace']}</strong>'</span><br>";
        }
    }

    // Output the total replacements made across all files
    echo $count ? "<strong>$count</strong> <span>Total Replacements Made.</span>" : "<span>No matches found.</span>";
}

//----------------------------------------------------------------------------------------//
//@update file Replix.php
//@note if you have query or help about this project; feel free to contact info@hedows.com
$newVer = file_get_contents("https://github.com/MuhammadAsadNazeer/Replix/blob/main/latest-version.txt");
if($newVer > $version)
	echo "<a href='https://github.com/MuhammadAsadNazeer/Replix/blob/main/Replix-$newVer.php' download hidden id='download'></a>
	<script>
		if(confirm('New version is available. Download now?')){
        	document.getElementById('download').click();
    	} else {
			
    	}
	</script>";

?>

</div>
<footer> Replix is a Open Source Project. Design & Develop by <a href="https://hedows.com/">Hedows Technologies</a>.<footer>

<script>
    // Add a new search-replace pair
    function addPair(search = '', replace = '') {
        const pairHtml = `
            <div class="search-replace-pair">
                <input type="text" class="search" value="${search}" placeholder="Search" />
                <input type="text" class="replace" value="${replace}" placeholder="Replace" />
                <button type="button" onclick="removePair(this)">Remove</button>
            </div>
        `;
        $('#searchReplacePairs').append(pairHtml);
    }

    // Remove a specific search-replace pair
    function removePair(button) {
        $(button).parent().remove();
    }

    // Import search-replace pairs from JSON file
    $('#importFile').on('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                try {
                    const pairs = JSON.parse(e.target.result);
                    if (Array.isArray(pairs)) {
                        $('#searchReplacePairs').empty(); // Clear existing pairs
                        pairs.forEach(pair => addPair(pair.search, pair.replace)); // Add imported pairs
                    } else {
                        alert('Invalid JSON format. Expected an array of objects.');
                    }
                } catch (error) {
                    alert('Error reading JSON file: ' + error.message);
                }
            };
            reader.readAsText(file);
        }
    });

    // Export search-replace pairs as JSON
    function exportSearchReplace() {
        const pairs = [];
        $('.search-replace-pair').each(function () {
            const search = $(this).find('.search').val();
            const replace = $(this).find('.replace').val();
            if (search && replace) {
                pairs.push({ search, replace });
            }
        });

        if (pairs.length === 0) {
            alert('No search-replace pairs to export.');
            return;
        }

        const json = JSON.stringify(pairs, null, 2); // Beautify JSON
        const blob = new Blob([json], { type: 'application/json' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = 'search-replace.json';
        document.body.appendChild(link); // Append link to body for Firefox
        link.click();
        document.body.removeChild(link); // Clean up after download
    }

    // Handle form submission
    function submit_form() {
        const pairs = [];
        $('.search-replace-pair').each(function () {
            const search = $(this).find('.search').val();
            const replace = $(this).find('.replace').val();
            if (search && replace) {
                pairs.push({ search, replace });
            }
        });

        $('#searchReplacePairsHidden').val(JSON.stringify(pairs));
        $('#searchForum').submit();
    }
</script>

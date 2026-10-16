<?php
header('Content-Type: text/html');
$gb_path = "gb.tsv";

echo <<<'EOD'
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="color-scheme" content="light dark">
	<title>Hot Pixels Guestbook | pnppl.cc</title>
	<style><!--
	body {
		margin: 0 auto;
		max-width: fit-content;
		padding: 0.25em;
		/* background: pink; */
		background: #eee;
	}
	h3,
	form,
	code,
	input[type="text"],
	input[type="url"],
	input[type="email"],
	input[type="button"],
	input[type="submit"],
	#entries {
		font-family: "Victor Mono Medium", monospace;
	}
	form > br,
	label {
		display: block;
	}
	label {
		margin: 0.5em 0;
	}
	form {
		padding: 1em 4em 18em;
		/* border: 1px solid hotpink; */
		/* background: hotpink; */
		color: black;
		/* background: dodgerblue; */
		background: #80c0ff;
		/* border: 1px solid midnightblue; */
		border: 1em outset midnightblue;
		border-radius: 8em;
		box-shadow: 0px 10px 10px rgba(0, 0, 0, 50%);
		max-width: 30em;
	}
	h1 {
		font-weight: normal;
	}
	form > p {
		color: white;
		background: black;
		padding: 1em;
		border: 0.5em inset black;
		border-radius: 2em;
	}
	input[type="text"],
	input[type="url"],
	input[type="email"],
	textarea {
		width: 75%;
	}
	.note {
		font-size: 0.9em;
//		margin-left: 11ch;
		margin: 0.25em 0 0.5em 6em;
		display: block;
	}
	#submit {
		font-size: 1em;
		margin-top: 0.5em;
		padding: 0.25em;
	}
	.center {
		margin: auto;
		width:fit-content;
		display: block;
	}
	.hide {
		display: none;
	}
	.inline {
		display: inline;
	}
	#pixelwrap {
		margin-left: 10ch;
		margin-top: 1em;
		/* fallback */
		width: 13.5em;
	}
	#pixelcheck {
		font-size: 0;
		line-height: 0;
		border: 1px solid hotpink;
		display: block;
		display: inline-block;
	}
	#pixelwrap,
	#pixelcheck {
		width: fit-content;
		overflow: visible;
		text-wrap: nowrap;
		white-space: nowrap;
		word-break: keep-all;
		touch-action: none;
		user-select: none;
	}
	.pixel {
		margin: 0;
		padding: 0;
		appearance: none;
		font-size: initial;
		width: 1em;
		height: 1em;
		border-radius: 0;
		border: 1px dotted #ccc;
	}
	.highlight {
		outline: hotpink dotted 2px;
		outline-offset: -1px;
		position: relative;
	}
	.nohighlight {
		outline: 0;
		position: static;
	}
	#invert ~ label {
		display: inline;
	}
	#pixelcheck .pixel:checked,
	#invert:checked ~ #pixelwrap #pixelcheck .pixel {
		background: black;
	}
	#pixelcheck .pixel,
	#invert:checked ~ #pixelwrap #pixelcheck .pixel:checked {
		background: white;
	}
	#controls label {
		display: inline;
	}
	#entries {
		display: flex;
		flex-direction: column-reverse;
		width: fit-content;
		padding: 2em;
		background: white;
		color: black;
		list-style: none;
		border: 1px solid gray;
		border-top: 4px solid black;
		border-bottom-width: 2px;
		border-radius: 5%;
		margin: -18em auto 2em;
		font-size: 0.9em;
		box-shadow: 0px 10px 10px rgba(0, 0, 0, 50%);
		overflow-wrap: anywhere;
	}
	#entries li {
		max-width: 20em;
	}
	form a {
		color: #00CADB;
	}
	form a:visited {
		color: plum;
	}
	#entries a {
		color: black;
		text-decoration-skip-ink: none;
	}
	#entries i {
		font-style: normal;
	}
	.comment {
		width: fit-content;
		margin: 0;
	}
	.comment p {
		margin: 2em 0;
	}
	.comment p::before {
		content: '« ';
	}
	.comment p:after {
		content: ' »';
	}
	.gif {
		display: block;
		/* width: 64px; */
		width: 18em;
		/* height: 64px; */
		height: 18em;
		/* border: 1px solid hotpink; */
		border: 0;
		image-rendering: crisp-edges;
		image-rendering: pixelated;
		margin-top: 2em;
	}
	.hr {
		margin: 4em auto 3em;
	}
	.hr:last-of-type {
		display: none;
	}
	@media (prefers-color-scheme: dark) {
		body {
			background: black;
		}
	}
	@media screen and (max-width: 640px) {
		input[type="text"],
		input[type="url"],
		input[type="email"],
		textarea{
			width: 50%;
		}
		#controls span {
			display: none;
		}
		form {
			padding: 1em;
			padding-bottom: 18em;
			border: 0;
			border-radius: 0;
		}
	}
	@media screen and (max-width: 400px) {
		input[type="text"],
		input[type="url"],
		input[type="email"],
		textarea{
			width: 98%;
		}
		#pixelwrap {
			margin: 0.5em auto;
		}
		.note {
			margin: 0.5em auto;
			display: block;
			width: fit-content;
		}
	}
	--></style>
</head>
<body>
	<form method="post" action="submit/">
		<h1 class="center"><b style="color:hotpink">Hot </b>Pixels Guestbook</h1>
		<p>Submissions are automatically printed by <a href="irl.jpg">my thermal receipt printer</a> every 10 minutes.</p>
		<p>I will personally hear, admire, touch, and smell your steaming pixels.</p>
		<p>All fields except CAPTCHA are optional, but you must answer at least one! You can submit once per day (resets at 11:11 NYC).</p>
		<br>
		<label><code>Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><input type="text" name="name" placeholder="pnppl" maxlength="100"></label>
		<br>
		<label><code>Homepage:&nbsp;</code><input type="url" name="url" placeholder="http://pnppl.cc/" maxlength="400"></label>
		<br>
		<label><code>Email:&nbsp;&nbsp;&nbsp;&nbsp;</code><input type="email" name="email" placeholder="guestbook@pnppl.cc" maxlength="100"></label>
		<br>
		<code class="note"><b><i><span class="hide">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Email will be published.</i></b></code>
		<br>
		<label><span style="vertical-align: top"><code>Comment:&nbsp;&nbsp;</code></span><textarea name="comment" placeholder="cool site" maxlength="4000"></textarea></label>
		<br class="inline">
		<code>Art:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><input type="checkbox" id="invert" name="invert"><label for="invert"><code>&nbsp;Invert colors</code><br></label>
		<br>
		<div id="pixelwrap">
			<div id="pixelcheck">
				<input type="checkbox" class="pixel" name="pixel0" id="pixel0">
				<input type="checkbox" class="pixel" name="pixel1" id="pixel1">
				<input type="checkbox" class="pixel" name="pixel2" id="pixel2">
				<input type="checkbox" class="pixel" name="pixel3" id="pixel3">
				<input type="checkbox" class="pixel" name="pixel4" id="pixel4">
				<input type="checkbox" class="pixel" name="pixel5" id="pixel5">
				<input type="checkbox" class="pixel" name="pixel6" id="pixel6">
				<input type="checkbox" class="pixel" name="pixel7" id="pixel7">
				<input type="checkbox" class="pixel" name="pixel8" id="pixel8">
				<input type="checkbox" class="pixel" name="pixel9" id="pixel9">
				<input type="checkbox" class="pixel" name="pixel10" id="pixel10">
				<input type="checkbox" class="pixel" name="pixel11" id="pixel11">
				<input type="checkbox" class="pixel" name="pixel12" id="pixel12">
				<input type="checkbox" class="pixel" name="pixel13" id="pixel13">
				<input type="checkbox" class="pixel" name="pixel14" id="pixel14">
				<input type="checkbox" class="pixel" name="pixel15" id="pixel15">
				<br>
				<input type="checkbox" class="pixel" name="pixel16" id="pixel16">
				<input type="checkbox" class="pixel" name="pixel17" id="pixel17">
				<input type="checkbox" class="pixel" name="pixel18" id="pixel18">
				<input type="checkbox" class="pixel" name="pixel19" id="pixel19">
				<input type="checkbox" class="pixel" name="pixel20" id="pixel20">
				<input type="checkbox" class="pixel" name="pixel21" id="pixel21">
				<input type="checkbox" class="pixel" name="pixel22" id="pixel22">
				<input type="checkbox" class="pixel" name="pixel23" id="pixel23">
				<input type="checkbox" class="pixel" name="pixel24" id="pixel24">
				<input type="checkbox" class="pixel" name="pixel25" id="pixel25">
				<input type="checkbox" class="pixel" name="pixel26" id="pixel26">
				<input type="checkbox" class="pixel" name="pixel27" id="pixel27">
				<input type="checkbox" class="pixel" name="pixel28" id="pixel28">
				<input type="checkbox" class="pixel" name="pixel29" id="pixel29">
				<input type="checkbox" class="pixel" name="pixel30" id="pixel30">
				<input type="checkbox" class="pixel" name="pixel31" id="pixel31">
				<br>
				<input type="checkbox" class="pixel" name="pixel32" id="pixel32">
				<input type="checkbox" class="pixel" name="pixel33" id="pixel33">
				<input type="checkbox" class="pixel" name="pixel34" id="pixel34">
				<input type="checkbox" class="pixel" name="pixel35" id="pixel35">
				<input type="checkbox" class="pixel" name="pixel36" id="pixel36">
				<input type="checkbox" class="pixel" name="pixel37" id="pixel37">
				<input type="checkbox" class="pixel" name="pixel38" id="pixel38">
				<input type="checkbox" class="pixel" name="pixel39" id="pixel39">
				<input type="checkbox" class="pixel" name="pixel40" id="pixel40">
				<input type="checkbox" class="pixel" name="pixel41" id="pixel41">
				<input type="checkbox" class="pixel" name="pixel42" id="pixel42">
				<input type="checkbox" class="pixel" name="pixel43" id="pixel43">
				<input type="checkbox" class="pixel" name="pixel44" id="pixel44">
				<input type="checkbox" class="pixel" name="pixel45" id="pixel45">
				<input type="checkbox" class="pixel" name="pixel46" id="pixel46">
				<input type="checkbox" class="pixel" name="pixel47" id="pixel47">
				<br>
				<input type="checkbox" class="pixel" name="pixel48" id="pixel48">
				<input type="checkbox" class="pixel" name="pixel49" id="pixel49">
				<input type="checkbox" class="pixel" name="pixel50" id="pixel50">
				<input type="checkbox" class="pixel" name="pixel51" id="pixel51">
				<input type="checkbox" class="pixel" name="pixel52" id="pixel52">
				<input type="checkbox" class="pixel" name="pixel53" id="pixel53">
				<input type="checkbox" class="pixel" name="pixel54" id="pixel54">
				<input type="checkbox" class="pixel" name="pixel55" id="pixel55">
				<input type="checkbox" class="pixel" name="pixel56" id="pixel56">
				<input type="checkbox" class="pixel" name="pixel57" id="pixel57">
				<input type="checkbox" class="pixel" name="pixel58" id="pixel58">
				<input type="checkbox" class="pixel" name="pixel59" id="pixel59">
				<input type="checkbox" class="pixel" name="pixel60" id="pixel60">
				<input type="checkbox" class="pixel" name="pixel61" id="pixel61">
				<input type="checkbox" class="pixel" name="pixel62" id="pixel62">
				<input type="checkbox" class="pixel" name="pixel63" id="pixel63">
				<br>
				<input type="checkbox" class="pixel" name="pixel64" id="pixel64">
				<input type="checkbox" class="pixel" name="pixel65" id="pixel65">
				<input type="checkbox" class="pixel" name="pixel66" id="pixel66">
				<input type="checkbox" class="pixel" name="pixel67" id="pixel67">
				<input type="checkbox" class="pixel" name="pixel68" id="pixel68">
				<input type="checkbox" class="pixel" name="pixel69" id="pixel69">
				<input type="checkbox" class="pixel" name="pixel70" id="pixel70">
				<input type="checkbox" class="pixel" name="pixel71" id="pixel71">
				<input type="checkbox" class="pixel" name="pixel72" id="pixel72">
				<input type="checkbox" class="pixel" name="pixel73" id="pixel73">
				<input type="checkbox" class="pixel" name="pixel74" id="pixel74">
				<input type="checkbox" class="pixel" name="pixel75" id="pixel75">
				<input type="checkbox" class="pixel" name="pixel76" id="pixel76">
				<input type="checkbox" class="pixel" name="pixel77" id="pixel77">
				<input type="checkbox" class="pixel" name="pixel78" id="pixel78">
				<input type="checkbox" class="pixel" name="pixel79" id="pixel79">
				<br>
				<input type="checkbox" class="pixel" name="pixel80" id="pixel80">
				<input type="checkbox" class="pixel" name="pixel81" id="pixel81">
				<input type="checkbox" class="pixel" name="pixel82" id="pixel82">
				<input type="checkbox" class="pixel" name="pixel83" id="pixel83">
				<input type="checkbox" class="pixel" name="pixel84" id="pixel84">
				<input type="checkbox" class="pixel" name="pixel85" id="pixel85">
				<input type="checkbox" class="pixel" name="pixel86" id="pixel86">
				<input type="checkbox" class="pixel" name="pixel87" id="pixel87">
				<input type="checkbox" class="pixel" name="pixel88" id="pixel88">
				<input type="checkbox" class="pixel" name="pixel89" id="pixel89">
				<input type="checkbox" class="pixel" name="pixel90" id="pixel90">
				<input type="checkbox" class="pixel" name="pixel91" id="pixel91">
				<input type="checkbox" class="pixel" name="pixel92" id="pixel92">
				<input type="checkbox" class="pixel" name="pixel93" id="pixel93">
				<input type="checkbox" class="pixel" name="pixel94" id="pixel94">
				<input type="checkbox" class="pixel" name="pixel95" id="pixel95">
				<br>
				<input type="checkbox" class="pixel" name="pixel96" id="pixel96">
				<input type="checkbox" class="pixel" name="pixel97" id="pixel97">
				<input type="checkbox" class="pixel" name="pixel98" id="pixel98">
				<input type="checkbox" class="pixel" name="pixel99" id="pixel99">
				<input type="checkbox" class="pixel" name="pixel100" id="pixel100">
				<input type="checkbox" class="pixel" name="pixel101" id="pixel101">
				<input type="checkbox" class="pixel" name="pixel102" id="pixel102">
				<input type="checkbox" class="pixel" name="pixel103" id="pixel103">
				<input type="checkbox" class="pixel" name="pixel104" id="pixel104">
				<input type="checkbox" class="pixel" name="pixel105" id="pixel105">
				<input type="checkbox" class="pixel" name="pixel106" id="pixel106">
				<input type="checkbox" class="pixel" name="pixel107" id="pixel107">
				<input type="checkbox" class="pixel" name="pixel108" id="pixel108">
				<input type="checkbox" class="pixel" name="pixel109" id="pixel109">
				<input type="checkbox" class="pixel" name="pixel110" id="pixel110">
				<input type="checkbox" class="pixel" name="pixel111" id="pixel111">
				<br>
				<input type="checkbox" class="pixel" name="pixel112" id="pixel112">
				<input type="checkbox" class="pixel" name="pixel113" id="pixel113">
				<input type="checkbox" class="pixel" name="pixel114" id="pixel114">
				<input type="checkbox" class="pixel" name="pixel115" id="pixel115">
				<input type="checkbox" class="pixel" name="pixel116" id="pixel116">
				<input type="checkbox" class="pixel" name="pixel117" id="pixel117">
				<input type="checkbox" class="pixel" name="pixel118" id="pixel118">
				<input type="checkbox" class="pixel" name="pixel119" id="pixel119">
				<input type="checkbox" class="pixel" name="pixel120" id="pixel120">
				<input type="checkbox" class="pixel" name="pixel121" id="pixel121">
				<input type="checkbox" class="pixel" name="pixel122" id="pixel122">
				<input type="checkbox" class="pixel" name="pixel123" id="pixel123">
				<input type="checkbox" class="pixel" name="pixel124" id="pixel124">
				<input type="checkbox" class="pixel" name="pixel125" id="pixel125">
				<input type="checkbox" class="pixel" name="pixel126" id="pixel126">
				<input type="checkbox" class="pixel" name="pixel127" id="pixel127">
				<br>
				<input type="checkbox" class="pixel" name="pixel128" id="pixel128">
				<input type="checkbox" class="pixel" name="pixel129" id="pixel129">
				<input type="checkbox" class="pixel" name="pixel130" id="pixel130">
				<input type="checkbox" class="pixel" name="pixel131" id="pixel131">
				<input type="checkbox" class="pixel" name="pixel132" id="pixel132">
				<input type="checkbox" class="pixel" name="pixel133" id="pixel133">
				<input type="checkbox" class="pixel" name="pixel134" id="pixel134">
				<input type="checkbox" class="pixel" name="pixel135" id="pixel135">
				<input type="checkbox" class="pixel" name="pixel136" id="pixel136">
				<input type="checkbox" class="pixel" name="pixel137" id="pixel137">
				<input type="checkbox" class="pixel" name="pixel138" id="pixel138">
				<input type="checkbox" class="pixel" name="pixel139" id="pixel139">
				<input type="checkbox" class="pixel" name="pixel140" id="pixel140">
				<input type="checkbox" class="pixel" name="pixel141" id="pixel141">
				<input type="checkbox" class="pixel" name="pixel142" id="pixel142">
				<input type="checkbox" class="pixel" name="pixel143" id="pixel143">
				<br>
				<input type="checkbox" class="pixel" name="pixel144" id="pixel144">
				<input type="checkbox" class="pixel" name="pixel145" id="pixel145">
				<input type="checkbox" class="pixel" name="pixel146" id="pixel146">
				<input type="checkbox" class="pixel" name="pixel147" id="pixel147">
				<input type="checkbox" class="pixel" name="pixel148" id="pixel148">
				<input type="checkbox" class="pixel" name="pixel149" id="pixel149">
				<input type="checkbox" class="pixel" name="pixel150" id="pixel150">
				<input type="checkbox" class="pixel" name="pixel151" id="pixel151">
				<input type="checkbox" class="pixel" name="pixel152" id="pixel152">
				<input type="checkbox" class="pixel" name="pixel153" id="pixel153">
				<input type="checkbox" class="pixel" name="pixel154" id="pixel154">
				<input type="checkbox" class="pixel" name="pixel155" id="pixel155">
				<input type="checkbox" class="pixel" name="pixel156" id="pixel156">
				<input type="checkbox" class="pixel" name="pixel157" id="pixel157">
				<input type="checkbox" class="pixel" name="pixel158" id="pixel158">
				<input type="checkbox" class="pixel" name="pixel159" id="pixel159">
				<br>
				<input type="checkbox" class="pixel" name="pixel160" id="pixel160">
				<input type="checkbox" class="pixel" name="pixel161" id="pixel161">
				<input type="checkbox" class="pixel" name="pixel162" id="pixel162">
				<input type="checkbox" class="pixel" name="pixel163" id="pixel163">
				<input type="checkbox" class="pixel" name="pixel164" id="pixel164">
				<input type="checkbox" class="pixel" name="pixel165" id="pixel165">
				<input type="checkbox" class="pixel" name="pixel166" id="pixel166">
				<input type="checkbox" class="pixel" name="pixel167" id="pixel167">
				<input type="checkbox" class="pixel" name="pixel168" id="pixel168">
				<input type="checkbox" class="pixel" name="pixel169" id="pixel169">
				<input type="checkbox" class="pixel" name="pixel170" id="pixel170">
				<input type="checkbox" class="pixel" name="pixel171" id="pixel171">
				<input type="checkbox" class="pixel" name="pixel172" id="pixel172">
				<input type="checkbox" class="pixel" name="pixel173" id="pixel173">
				<input type="checkbox" class="pixel" name="pixel174" id="pixel174">
				<input type="checkbox" class="pixel" name="pixel175" id="pixel175">
				<br>
				<input type="checkbox" class="pixel" name="pixel176" id="pixel176">
				<input type="checkbox" class="pixel" name="pixel177" id="pixel177">
				<input type="checkbox" class="pixel" name="pixel178" id="pixel178">
				<input type="checkbox" class="pixel" name="pixel179" id="pixel179">
				<input type="checkbox" class="pixel" name="pixel180" id="pixel180">
				<input type="checkbox" class="pixel" name="pixel181" id="pixel181">
				<input type="checkbox" class="pixel" name="pixel182" id="pixel182">
				<input type="checkbox" class="pixel" name="pixel183" id="pixel183">
				<input type="checkbox" class="pixel" name="pixel184" id="pixel184">
				<input type="checkbox" class="pixel" name="pixel185" id="pixel185">
				<input type="checkbox" class="pixel" name="pixel186" id="pixel186">
				<input type="checkbox" class="pixel" name="pixel187" id="pixel187">
				<input type="checkbox" class="pixel" name="pixel188" id="pixel188">
				<input type="checkbox" class="pixel" name="pixel189" id="pixel189">
				<input type="checkbox" class="pixel" name="pixel190" id="pixel190">
				<input type="checkbox" class="pixel" name="pixel191" id="pixel191">
				<br>
				<input type="checkbox" class="pixel" name="pixel192" id="pixel192">
				<input type="checkbox" class="pixel" name="pixel193" id="pixel193">
				<input type="checkbox" class="pixel" name="pixel194" id="pixel194">
				<input type="checkbox" class="pixel" name="pixel195" id="pixel195">
				<input type="checkbox" class="pixel" name="pixel196" id="pixel196">
				<input type="checkbox" class="pixel" name="pixel197" id="pixel197">
				<input type="checkbox" class="pixel" name="pixel198" id="pixel198">
				<input type="checkbox" class="pixel" name="pixel199" id="pixel199">
				<input type="checkbox" class="pixel" name="pixel200" id="pixel200">
				<input type="checkbox" class="pixel" name="pixel201" id="pixel201">
				<input type="checkbox" class="pixel" name="pixel202" id="pixel202">
				<input type="checkbox" class="pixel" name="pixel203" id="pixel203">
				<input type="checkbox" class="pixel" name="pixel204" id="pixel204">
				<input type="checkbox" class="pixel" name="pixel205" id="pixel205">
				<input type="checkbox" class="pixel" name="pixel206" id="pixel206">
				<input type="checkbox" class="pixel" name="pixel207" id="pixel207">
				<br>
				<input type="checkbox" class="pixel" name="pixel208" id="pixel208">
				<input type="checkbox" class="pixel" name="pixel209" id="pixel209">
				<input type="checkbox" class="pixel" name="pixel210" id="pixel210">
				<input type="checkbox" class="pixel" name="pixel211" id="pixel211">
				<input type="checkbox" class="pixel" name="pixel212" id="pixel212">
				<input type="checkbox" class="pixel" name="pixel213" id="pixel213">
				<input type="checkbox" class="pixel" name="pixel214" id="pixel214">
				<input type="checkbox" class="pixel" name="pixel215" id="pixel215">
				<input type="checkbox" class="pixel" name="pixel216" id="pixel216">
				<input type="checkbox" class="pixel" name="pixel217" id="pixel217">
				<input type="checkbox" class="pixel" name="pixel218" id="pixel218">
				<input type="checkbox" class="pixel" name="pixel219" id="pixel219">
				<input type="checkbox" class="pixel" name="pixel220" id="pixel220">
				<input type="checkbox" class="pixel" name="pixel221" id="pixel221">
				<input type="checkbox" class="pixel" name="pixel222" id="pixel222">
				<input type="checkbox" class="pixel" name="pixel223" id="pixel223">
				<br>
				<input type="checkbox" class="pixel" name="pixel224" id="pixel224">
				<input type="checkbox" class="pixel" name="pixel225" id="pixel225">
				<input type="checkbox" class="pixel" name="pixel226" id="pixel226">
				<input type="checkbox" class="pixel" name="pixel227" id="pixel227">
				<input type="checkbox" class="pixel" name="pixel228" id="pixel228">
				<input type="checkbox" class="pixel" name="pixel229" id="pixel229">
				<input type="checkbox" class="pixel" name="pixel230" id="pixel230">
				<input type="checkbox" class="pixel" name="pixel231" id="pixel231">
				<input type="checkbox" class="pixel" name="pixel232" id="pixel232">
				<input type="checkbox" class="pixel" name="pixel233" id="pixel233">
				<input type="checkbox" class="pixel" name="pixel234" id="pixel234">
				<input type="checkbox" class="pixel" name="pixel235" id="pixel235">
				<input type="checkbox" class="pixel" name="pixel236" id="pixel236">
				<input type="checkbox" class="pixel" name="pixel237" id="pixel237">
				<input type="checkbox" class="pixel" name="pixel238" id="pixel238">
				<input type="checkbox" class="pixel" name="pixel239" id="pixel239">
				<br>
				<input type="checkbox" class="pixel" name="pixel240" id="pixel240">
				<input type="checkbox" class="pixel" name="pixel241" id="pixel241">
				<input type="checkbox" class="pixel" name="pixel242" id="pixel242">
				<input type="checkbox" class="pixel" name="pixel243" id="pixel243">
				<input type="checkbox" class="pixel" name="pixel244" id="pixel244">
				<input type="checkbox" class="pixel" name="pixel245" id="pixel245">
				<input type="checkbox" class="pixel" name="pixel246" id="pixel246">
				<input type="checkbox" class="pixel" name="pixel247" id="pixel247">
				<input type="checkbox" class="pixel" name="pixel248" id="pixel248">
				<input type="checkbox" class="pixel" name="pixel249" id="pixel249">
				<input type="checkbox" class="pixel" name="pixel250" id="pixel250">
				<input type="checkbox" class="pixel" name="pixel251" id="pixel251">
				<input type="checkbox" class="pixel" name="pixel252" id="pixel252">
				<input type="checkbox" class="pixel" name="pixel253" id="pixel253">
				<input type="checkbox" class="pixel" name="pixel254" id="pixel254">
				<input type="checkbox" class="pixel" name="pixel255" id="pixel255">
			</div>
		</div>
		<br class="inline">
		<div id="controls"></div>
		<br class="inline">
		<code class="note"><b><span class="hide">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Whose commonplace is this?</b></code>
		<br>
		<label><code>CAPTCHA:&nbsp;&nbsp;</code><input type="text" name="captcha" placeholder="hint: it's 5 letters" width="10" maxlength="40"></label>
		<br>
		<code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</code><input type="submit" value="Submit" id="submit">
		<br>
		<code class="note"><b><i>IP will be stored for abuse prevention.</i></b></code>
	</form>
	<hr class="hide">
	<ul id="entries">

EOD;

if (($gb_file = fopen($gb_path, "r")) !== false) {
	while (($entry = fgetcsv($gb_file, 5000, "\t", '\\', '')) !== false) {
		$date = $entry[0];
		$date_friendly = date('Y-m-d (D.) @ H:i:s', $date);
		$name = $entry[1];
		$url = $entry[2] ?? '';
		$url_bare = preg_replace('/^https?:\/\//i', '', $url, 1);
		$url_bare = preg_replace('/\/$/', '', $url_bare, 1);
		$email = $entry[3] ?? '';
		$email_decimal = implode("", array_map(fn($char) => "&#" . ord($char) . ";", str_split($email)));
		$comment = $entry[4] ?? '';
		$pic = $entry[5] ?? '';
		echo <<<EOD
				<li id="$date">
					<a name="$date" id="$date" title="$date">$date_friendly</a>
					<br>

		EOD;
		if (strlen($email) > 4) {
			echo <<<EOD
					$name <a href="mailto:$email_decimal">[$email_decimal]</a>
					<br>

		EOD;
		}
		else {
			echo <<<EOD
					$name
					<br>

		EOD;
		}
		if (strlen($url) > 4) {
			echo <<<EOD
					<a href="$url">$url_bare</a>
					<br>

		EOD;
		}
		if (strlen($comment) > 0 || strlen($pic) === 256) {
			echo <<<EOD
					<blockquote class="comment">

			EOD;

			if (strlen($comment) > 0) {
				echo <<<EOD
							<p><i>$comment</i></p>

				EOD;
			}

			if (strlen($pic) === 256) {
				echo <<<EOD
							<a href="text/?pic=$pic" title="load text version"><img class="gif" src="gif/$date.gif" width="16" height="16" alt="art for post $date"></a>

				EOD;
			}

			echo <<<EOD
					</blockquote>
			EOD;
		}
		echo <<<EOD
				</li>
				<p class="hr">_ * ~ * _ * ~ * _ * ~ * _ * ~</p>
			EOD;
	}
	fclose($gb_file);
}
else {
	echo "\t<b>Can't read guestbook file</b>";
}

echo <<<'EOD'
	</ul>
	<p class="center"><a href="https://git.gay/pnppl/gb/">AGPLv3</a> &#183; <a href="status">printer status</a> &#183; <a href="mailto:&#103;&#98;&#64;&#112;&#110;&#112;&#112;&#108;&#46;&#99;&#99;">&#103;&#98;&#64;&#112;&#110;&#112;&#112;&#108;&#46;&#99;&#99;</a></p>
	<script><!--
	// this was basic prog enhance so you could click and drag but it got a little out of hand

	// pretty ugly but maybe the least bad option? removing the class doesn't seem to trigger a CSS redraw
	function setHighlight(on) {
		if (checkFirstPixel()) {
			if (on) {
				firstPixel.className = 'pixel highlight';
			}
			else {
				firstPixel.className = 'pixel nohighlight';
			}
		}
	}

	function dodo(popStack, pushStack) {
		if (popStack.length > 0) {
			lastPixelNum = popStack.pop();
			pushStack.push(lastPixelNum);
			lastPixel = document.getElementById('pixel' + lastPixelNum);
			lastPixel.checked = !lastPixel.checked;
		}
	}
	function undo() {
		dodo(pixelHistory, pixelFuture);
	}
	function redo() {
		dodo(pixelFuture, pixelHistory);
	}

	// needed to debounce mobile drags
	function pushCurrDrag(pix) {
		for (i = 0; i < currDrag.length; i++) {
			if (currDrag[i] == pix) {
				return;
			}
		}
		currDrag.push(pix);
		pixelHistory.push(pix);
		pixelFuture.length = 0;
	}

	function setStraight(state) {
		isStraight = state;
		straightBox.checked = state;
		if (mouseIsDown) {
			setHighlight(state);
		}
	}

	function toggleStraight(e) {
		setStraight(straightBox.checked);
	}

	function endStraight(e) {
		if (e.key == 'Shift') {
			setStraight(false);
		}
	}

	function noClick(e) {
		e.preventDefault();
	}
	
	// 'target' is misleading - all touch move events show the first target
	function getRealTarget(e) {
		if (e.pointerType == 'touch') {
			pixel = document.elementFromPoint(e.clientX, e.clientY);
			if (isPixel(pixel)) {
				return pixel;
			}
		}
		else if (isPixel(e.target)) {
			return e.target;
		}
		return 'FUCK';
	}

	// i am in hell
	// everything is all fucked because of ^ this annoying targeting bullshit
	function isPixel(pix) {
		if (typeof pix != 'undefined' &&
			pix != null &&
			pix != 'FUCK' &&
			pix.tagName == 'INPUT' &&
			pix.type == 'checkbox' &&
			pix.id.match(/^pixel/)) {
			return true;
		}
		return false;
	}

	function checkFirstPixel() {
		if (typeof firstPixel != 'undefined' && isPixel(firstPixel)) {
			return true;
		}
		return false;
	}

	function startDraw(e) {
		firstPixel = getRealTarget(e);
		if (checkFirstPixel()) {
			mouseIsDown = true;
			if (isStraight) {
				setHighlight(true);
			}
			firstPixelWasOn = firstPixel.checked;
			firstPixel.checked = !firstPixel.checked;

			firstPixelNum = firstPixel.id.replace('pixel', '');
			pixelFuture.length = 0;
			pushCurrDrag(firstPixelNum);
		}
	}

	function contDraw(e) {
		if (mouseIsDown && checkFirstPixel()) {
			pixel = getRealTarget(e);
			if (pixel != 'FUCK') {
				pixelNum = pixel.id.replace('pixel', '');

				if (isStraight) {
					row = Math.floor(pixelNum / 16);
					col = pixelNum % 16;
					firstRow = Math.floor(firstPixelNum / 16);
					firstCol = firstPixelNum % 16;
					if (! (row == firstRow || col == firstCol)) {
						return;
					}
				}

				if (pixel.checked != !firstPixelWasOn) {
					pixel.checked = !firstPixelWasOn;
					pushCurrDrag(pixelNum);
				}
			}
		}
	}

	function endDraw(e) {
		mouseIsDown = false;
		setHighlight(false);
		currDrag.length = 0;
		firstPixel = 'FUCK';
	}

	function keyDownWrap(e) {
		// don't mess with art when user is typing
		type = e.target.type;
		if (type == 'textarea' || type == 'text' || type == 'url' || type == 'email') {
			return;
		}

		if (e.key == 'Z' || e.key == 'z') {
			undo();
		}
		else if (e.key == 'Y' || e.key == 'y') {
			redo();
		}
		else if (e.key == 'Shift') {
			setStraight(true);
		}
	}

	function desktopStart(e) {
		if (!isTouch()) {
			startDraw(e);
		}
	}	

	function mobileStart(e) {
		if (isTouch()) {
			startDraw(e);
		}
	}	

	function desktopCont(e) {
		if (!isTouch()) {
			contDraw(e);
		}
	}

	function mobileCont(e) {
		if (isTouch()) {
			if (!mouseIsDown) {
				startDraw(e);
			}
			else {
				contDraw(e);
			}
		}
	}

	// based AI???
	function isTouch() {
	  return (
	    ('ontouchstart' in window) ||
	    (navigator.maxTouchPoints > 0) ||
	    (navigator.msMaxTouchPoints > 0)
	  );
	}

	// wrapped so we can return early
	function main() {
		// kill alerts in eg netscape 3
		if (typeof document.getElementById == 'undefined') {
			return;
		}

		// these controls do nothing without js, so insert them at runtime
		document.getElementById('controls').innerHTML = '<label><code><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><input type="checkbox" id="straight">&nbsp;Straight (<kbd>Shift</kbd>)</code></label> <input type="button" id="undo" value="Undo (Z)">&nbsp;<input type="button" id="redo" value="Redo (Y)">';

		// this shit is all global. who doesn't love state
		straightBox = document.getElementById('straight');
		isStraight = straightBox.checked;
		mouseIsDown = false;
		firstPixelWasOn = false;
		pixelHistory = new Array();
		pixelFuture = new Array();
		currDrag = new Array();

		// 'false' is some mystical param that old browsers need specified
		for (i = 0; i < 256; i++) {
			pixel = document.getElementById('pixel' + i);
			pixel.addEventListener('click', noClick, false);
			pixel.addEventListener('pointerdown', mobileStart, false);
			pixel.addEventListener('mousedown', desktopStart, false);
			pixel.addEventListener('mouseover', desktopCont, false);
		}
		window.addEventListener('pointermove', mobileCont, false);
		// kill it with fire
		window.addEventListener('mouseup', endDraw, false);
		window.addEventListener('pointerup', endDraw, false);
		window.addEventListener('touchcancel', endDraw, false);
		// kbd
		document.addEventListener('keydown', keyDownWrap, false);
		document.addEventListener('keyup', endStraight, false);
		// dom
		document.getElementById('undo').addEventListener('click', undo, false);
		document.getElementById('redo').addEventListener('click', redo, false);
		straightBox.addEventListener('click', toggleStraight, false);
	}
	main();
	//--></script>
</body>
</html>
EOD;

exit();
?>

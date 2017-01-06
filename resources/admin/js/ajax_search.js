var uri = 'http://localhost/~maulayyacyber/nyimakid/';

var category = new Bloodhound({
    datumTokenizer: function(d) {
        return Bloodhound.tokenizers.whitespace(d.judul);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: uri+'auth/category/json_search',
});
category.initialize();
category.clearPrefetchCache();
$('#category').typeahead({
        highlight: true,
        hint: true,
    },
    {
        displayKey: 'judul',
        source: category.ttAdapter()
    });

var videos = new Bloodhound({
    datumTokenizer: function(d) {
        return Bloodhound.tokenizers.whitespace(d.judul);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: uri+'auth/videos/json_search',
});
videos.initialize();
videos.clearPrefetchCache();
$('#videos').typeahead({
        highlight: true,
        hint: true,
    },
    {
        displayKey: 'judul',
        source: videos.ttAdapter()
    });

var pages = new Bloodhound({
    datumTokenizer: function(d) {
        return Bloodhound.tokenizers.whitespace(d.judul);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: uri+'auth/pages/json_search',
});
pages.initialize();
pages.clearPrefetchCache();
$('#pages').typeahead({
        highlight: true,
        hint: true,
    },
    {
        displayKey: 'judul',
        source: pages.ttAdapter()
    });

var feedback = new Bloodhound({
    datumTokenizer: function(d) {
        return Bloodhound.tokenizers.whitespace(d.judul);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: uri+'auth/feedback/json_search',
});
feedback.initialize();
feedback.clearPrefetchCache();
$('#feedback').typeahead({
        highlight: true,
        hint: true,
    },
    {
        displayKey: 'judul',
        source: feedback.ttAdapter()
    });

var bug = new Bloodhound({
    datumTokenizer: function(d) {
        return Bloodhound.tokenizers.whitespace(d.judul);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: uri+'auth/bug/json_search',
});
bug.initialize();
bug.clearPrefetchCache();
$('#bug').typeahead({
        highlight: true,
        hint: true,
    },
    {
        displayKey: 'judul',
        source: bug.ttAdapter()
    });
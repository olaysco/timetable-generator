/**
 * An object for managing tasks related to courses
 */
function Timetable(url, resourceName) {
    Resource.call(this, url, resourceName);
}

App.extend(Resource, Timetable);

Timetable.prototype.init = function() {
    var self = this;
    Resource.prototype.init.call(self);

    $(document).on('click', '.print-btn', function(event) {
        var url = '/timetables/view/' + $(this).data('id');
        var printWin = window.open('', '', 'width=5,height=5');

        event.preventDefault();
        self.printTimetable(printWin, url);
    });
};

Timetable.prototype.printTimetable = function(printWin, url) {
    $.get(url, null, function (response) {
        printWin.resizeTo(window.innerWidth, window.innerHeight);
        printWin.document.open();
        printWin.document.write(response);
        printWin.document.close();

        // Wait for the page to load, and after that we print and close the window
        printWin.onload = function () {
            printWin.focus();
            printWin.print();
            printWin.close();
        };
    });
};

Timetable.prototype.initializeAddModal = function() {
    var $modal = $('#resource-modal');
    Resource.prototype.initializeAddModal.call(this);

    // Set up modal title and button label
    $modal.find('.modal-heading').html('Create New Timetable Set');
    $modal.find('.submit-btn').html('Generate');
};


window.addEventListener('load', function () {
    var timetable = new Timetable('/timetables', 'Timetable');
    timetable.init();
    console.log(timetable.baseUrl);
});
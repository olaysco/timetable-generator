/**
 * An object for managing tasks related to courses
 */
function CollegeClass(url, resourceName) {
    Resource.call(this, url, resourceName);
}

App.extend(Resource, CollegeClass);

CollegeClass.prototype.init = function() {
    var self = this;

    Resource.prototype.init.call(self);

    $(document).on('click', '#course-add', function() {
        self.addCourse();
    });

    $(document).on('click', '.course-remove', function(event){
        var $el = $(event.target);
        var id = $el.data('id');

        $('#course-' + id + '-container').remove();
    });
};

CollegeClass.prototype.addCourse = function() {
    var template = $('#course-template').html();
    var id = new Date().valueOf();

    template = template.replace(/{ID}/g, id);
    $('#courses-container').append(template);
};

CollegeClass.prototype.prepareForUpdate = function (resource) {
    $('input[name=name]').val(resource.name);
};

window.addEventListener('load', function () {
    var collegeClass = new CollegeClass('/classes', 'class');
    collegeClass.init();
});
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
    $('[name=course-' + id +']').select2();
};

CollegeClass.prototype.prepareForUpdate = function (resource) {
    $('input[name=name]').val(resource.name);
};

CollegeClass.prototype.submitResourceForm = function() {
    var $form = $('#resource-form');
    var url = $form.attr('action');
    var form;

    var data = {
        _token: this.csrfToken,
        name: $form.find('[name=name]').val(),
        size: $form.find('[name=size]').val(),
        unavailable_rooms: $form.find('#rooms-select').val()
    };

    var courses = {};

    $('.course-form').each(function(index) {
        var $container = $(this);
        var courseId = $container.find('.course-select').val();
        var meetings = $container.find('.course-meetings').val();

        if (courseId && meetings) {
            courses[courseId] = {
                'meetings' : meetings
            };
        }
    });

    data.courses = courses;
    var formData = new FormData();
    App.appendFormdata(formData, data);

    form = {
        url: url,
        data: formData
    };

    App.submitForm(form, this.refreshPage, $('#errors-container'), true, true);
};

window.addEventListener('load', function () {
    var collegeClass = new CollegeClass('/classes', 'class');
    collegeClass.init();
});
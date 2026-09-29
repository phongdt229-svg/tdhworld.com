(function ($) {
	$(document).ready(function () {
		arrowpress_pre_install_demo()
	});
    $(document).on('click', '.tc-button-deregister', function (e) {
        e.preventDefault();
        var confirm = window.confirm($(this).data('confirm_deregister'));
        if (!confirm) {
            return;
        }

        window.location.href = $(this).data('url-deregister');
    });
	function arrowpress_pre_install_demo() {
		if ($('.tc-importer-wrapper').length == 0) {
			return;
		}
		$(document).on('change', '#arrowpress-select-page-builder', function () {

			var elem = $(this),
				elem_val = elem.val(),
				elem_parent = elem.parents('.tc-importer-wrapper'),
				data = {
					action    : 'arrowpress_update_chosen_builder',
					arrowpress_key  : 'arrowpress_page_builder_chosen',
					arrowpress_value: elem_val,
				};

			if (elem_val !== '') {
				elem_parent.removeClass('visual_composer');
				elem_parent.removeClass('site_origin');
				elem_parent.removeClass('elementor');
				elem_parent.addClass(elem_val);

				elem_parent.removeClass('overlay').addClass('loading');
				$.post(ajaxurl, data, function (response) {
					console.log(response);
					elem_parent.removeClass('loading');
				});
			} else {
				elem_parent.addClass('overlay');
			}

		});
	}
})(jQuery);

function arrowpressActivatePlugin() {
    const form = document.querySelector('.arrowpress-form-license');

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // remove all notice
            const notices = document.querySelectorAll('.arrowpress-license-notice');
            notices.forEach(function (notice) {
                notice.remove();
            });

            //Get all form data values
            const formData = new FormData(form);

            //Get the form values
            const data = {};

            for (const [key, value] of formData.entries()) {
                data[key] = value;
            }

            const btn = form.querySelector('[type="submit"]'),
                btnText = btn.innerHTML;

            btn.innerHTML = 'Activating...';

            btn.setAttribute('disabled', 'disabled');

            // Use wp.apiFetch to POST to the REST API
            wp.apiFetch({
                path: '/arrowpress/v1/license/activate',
                method: 'POST',
                data: data,
            }).then((response) => {
               // add message after form use insertAdjacentHTML.
               if ( response.status == 'success' ) {
                    form.insertAdjacentHTML('afterend', '<div class="arrowpress-license-notice arrowpress-license-notice--success text-success"><p>License activated successfully.</p></div>');

                    setTimeout(function () {
                        // Get param 'arrowpress_redirect' from url and redirect to that url.
                        const urlParams = new URLSearchParams(window.location.search);
                        let redirect_url = urlParams.get('arrowpress_redirect');
                       
                        if ( redirect_url ) {
                            window.location.href = redirect_url;
                        } else {
                            window.location.reload();
                        }
                    }, 800);
               } else {
                    form.insertAdjacentHTML('afterend', '<div class="arrowpress-license-notice arrowpress-license-notice--error text-error"><p>' + response.message + '</p></div>');
               }
            }).catch((error) => {
                // add message after form use error.message.
                form.insertAdjacentHTML('afterend', '<div class="arrowpress-license-notice arrowpress-license-notice--error text-error"><p>' + error.message + '</p></div>');
            }).finally(() => {
                // remove disable attribute to button
                btn.removeAttribute('disabled');
                btn.innerHTML = btnText;
            });
        });
    }
}

function arrowpressDeactivatePlugin() {
    const deactivateBtn = document.querySelector('.arrow-deactivate');

    if (deactivateBtn) {
        deactivateBtn.addEventListener('click', function (e) {
            e.preventDefault();

            // remove all notice
            const notices = document.querySelectorAll('.arrowpress-license-notice');
            notices.forEach(function (notice) {
                notice.remove();
            });

            const btnText = deactivateBtn.innerHTML;

            deactivateBtn.innerHTML = 'Deactivating...';

            deactivateBtn.setAttribute('disabled', 'disabled');

            // Use wp.apiFetch to POST to the REST API
            wp.apiFetch({
                path: '/arrowpress/v1/license/deactivate',
                method: 'POST'
            }).then((response) => {
                // add message after form use insertAdjacentHTML.
                if ( response.status == 'success' ) {
                    deactivateBtn.insertAdjacentHTML('afterend', '<div class="arrowpress-license-notice arrowpress-license-notice--success text-success"><p>License deactivated successfully.</p></div>');

                    setTimeout(function () {
                        window.location.reload();
                    }, 800);
                } else {
                    deactivateBtn.insertAdjacentHTML('afterend', '<div class="arrowpress-license-notice arrowpress-license-notice--error text-error"><p>' + response.message + '</p></div>');
                }
            }).catch((error) => {
                // add message after form use error.message.
                deactivateBtn.insertAdjacentHTML('afterend', '<div class="arrowpress-license-notice arrowpress-license-notice--error text-error"><p>' + error.message + '</p></div>');
            }).finally(() => {
                // remove disable attribute to button
                deactivateBtn.removeAttribute('disabled');
                deactivateBtn.innerHTML = btnText;
            });
        });
    }
}

function arrowpressUpdatePersonal() {
    const form = document.querySelector('.arrowpress-form-personal');
    const btn = document.querySelector('.arrow-personal-token');

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // remove all notice
            const notices = document.querySelectorAll('.arrowpress-license-notice');
            notices.forEach(function (notice) {
                notice.remove();
            });

            //Get all form data values
            const formData = new FormData(form);

            //Get the form values
            const data = {};

            for (const [key, value] of formData.entries()) {
                data[key] = value;
            }

            const btn = form.querySelector('[type="submit"]'),
                btnText = btn.innerHTML;

            btn.innerHTML = 'Activating...';

            btn.setAttribute('disabled', 'disabled');

            // Use wp.apiFetch to POST to the REST API
            wp.apiFetch({
                path: '/arrowpress/v1/license/update-personal',
                method: 'POST',
                data: data,
            }).then((response) => {
               // add message after form use insertAdjacentHTML.
               if ( response.status == 'success' ) {
                    form.insertAdjacentHTML('afterend', '<div class="arrowpress-license-notice arrowpress-license-notice--success text-success"><p>License activated successfully.</p></div>');

                    setTimeout(function () {
                        window.location.reload();
                    }, 800);
               } else {
                    form.insertAdjacentHTML('afterend', '<div class="arrowpress-license-notice arrowpress-license-notice--error text-error"><p>' + response.message + '</p></div>');
               }
            }).catch((error) => {
                // add message after form use error.message.
                form.insertAdjacentHTML('afterend', '<div class="arrowpress-license-notice arrowpress-license-notice--error text-error"><p>' + error.message + '</p></div>');
            }).finally(() => {
                // remove disable attribute to button
                btn.removeAttribute('disabled');
                btn.innerHTML = btnText;
            });
        });
    }

}

document.addEventListener('DOMContentLoaded', function () {
    arrowpressActivatePlugin();
    arrowpressDeactivatePlugin();
    arrowpressUpdatePersonal();
});
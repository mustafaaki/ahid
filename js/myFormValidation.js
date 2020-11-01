$(document).ready(function() {
	/**üye kayıt formu kontrol*/
    $('#memberForm')
        .formValidation({
        	locale: 'tr_TR',
            message: 'This value is not valid',
            //live: 'submitted',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                tc: {
                   validators: {
                        notEmpty: {                         	
                        },
                        regexp: { regexp: /^[0-9]+$/ },
                        stringLength: {
                            min: 11,
                            max: 11,
                            message: 'TC No 11 karakterli olmalıdır'
                        },
                        remote: {
                            url: base_url + 'members/tccheck',
                            data: { tc:
                                 function() {
                                  	return $( "#tcNumber" ).val();
                                 },
                                 uye_id:function() {
                                	 return $('input:hidden[name=uye_id]').val();
                                 },
                                 sube_id:function() {
                                	 return $('#form-sube-id').val();
                                	 
                                 }
                              },
                            message: 'Bu TC numaralı üye kaydedilmiş.',
                            type: 'POST'
                        }
                    }
                },
                ad: {
                    validators: {
                        notEmpty: { message: 'Ad boş bırakılamaz' },
                        regexp: {
                            regexp: /^[a-zA-Z\s\ç\Ç\Ş\ş\ü\Ü\ğ\Ğ\ı\I\ö\Ö\i\İ]+$/,
                            message: 'Ad sadece karakter içerebilir'
                        },
                        stringLength: {
                            min: 2,
                            max: 60,
                            message: 'Ad minimum 2 maksimum 60 karakterli olabilir.'
                        }      
                    }
                },
                soyad: {
                    validators: {
                        notEmpty: { message: 'Soyad boş bırakılamaz' },
                        regexp: {
                        	regexp: /^[a-zA-Z\s\ç\Ç\Ş\ş\ü\Ü\ğ\Ğ\ı\I\ö\Ö\i\İ]+$/,
                            message: 'Ad sadece karakter içerebilir'
                        },
                        stringLength: {
                            min: 1,
                            max: 60,
                            message: 'Ad minimum 2 maksimum 60 karakterli olabilir.'
                        }
                    }
                },
				cinsiyet: {
                    validators: {
                        notEmpty: { message: 'Cinsiyet boş bırakılamaz'}
                    }
                },
                email: {
                    validators: {
                        emailAddress: { message: 'Gerçesiz email adresi..'}
                    }
                },
				is_tel: {
                    validators: {
                        regexp: {
                            regexp: /^((\d{10}))$/,
                            message: 'Örnek: 3122228568'
                        }
                    }
                },
                cep_tel: {
                    validators: {
                        regexp: {
                            regexp: /^(5(\d{9}))$/,
                            message: 'Örnek: 5052228568'
                        }
                    }
                },
                sube_id: { validators: {
                	remote: {
                        
                      
                       
                    }                
                } },
                kurum: { validators: {} },
                meslek: { validators: {} },
                dogum_tarihi: {
                    validators: {
                    	date: { format: 'DD-MM-YYYY' }
                    }
                },
                kutuk_koy: { validators: {} },
                is_adres: { validators: {} },
                ev_adres: { validators: {} },
                dogum_il: { validators: {} },
                kutuk_il: { validators: {} },
                dogum_ilce: { validators: {} },
                kutuk_ilce: { validators: {} },
                is_il: { validators: {} },
                is_ilce: { validators: {} },
                is_mahalle: { validators: {} },
                is_semt: { validators: {} },
                ev_il: { validators: {} },
                ev_ilce: { validators: {} },
                ev_mahalle: { validators: {} },
                ev_semt: { validators: {} },
                onerenler: { validators: {} },
                kan_gurubu: { validators: {}} 
            }
        })
        .on('success.validator.fv', function(e, data) {
            // data.field     --> The field name
            // data.element   --> The field element
            // data.result    --> The result returned by the validator
            // data.validator --> The validator name

            if (data.field === 'tc' && data.validator === 'remote'
                && (data.result.available === false || data.result.available === 'false'))
            {
            	
                // The userName field passes the remote validator
                data.element                    // Get the field element
                    .closest('.form-group')     // Get the field parent

                    // Add has-warning class
                    .removeClass('has-success')
                    .addClass('has-warning')

                    // Show message
                    .find('small[data-fv-validator="remote"][data-fv-for="tc"]')
                        .show();
            }
        })
        // This event will be triggered when the field doesn't pass given validator
        .on('err.validator.fv', function(e, data) {
            // We need to remove has-warning class
            // when the field doesn't pass any validator
            if (data.field === 'tc') {
                data.element
                    .closest('.form-group')
                    .removeClass('has-warning');
            }
        })
        .on('success.form.fv', function(e) {
            // Prevent submit form
            e.preventDefault();

            var $form     = $(e.target),
                validator = $form.data('formValidation');
            $form.find('.alert').html('' + validator.getFieldElements('tcno').val()).show();
           
            document.getElementById("memberForm").submit();
        });
    
    
    
     /*şube kayıt kontrol*/
    
    $('#subeForm')
    .formValidation({
    	locale: 'tr_TR',
        message: 'This value is not valid',
        //live: 'submitted',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            sube_ad: {
               validators: {
                    notEmpty: {},
                    stringLength: {
                        min: 3,
                        max: 240,
                        message: 'Şube Adı minimum 3 maksimum 240 karakter içerebilir'
                    }                          
                }
            },
            sube_adres: {
                validators: {
                     notEmpty: {},
                     stringLength: {
                         min: 1,
                         max: 240,
                         message: 'Şube adresi minimum 3 maksimum 240 karakter içerebilir'
                     }                          
                 }
             },
             
             sube_no: {
                 validators: {
                      notEmpty: {},
                      stringLength: {
                          min: 1,
                          max: 240,
                          message: 'Şube Adı minimum 3 maksimum 240 karakter içerebilir'
                      },
                      regexp: {
                          regexp: /^[0-9]+$/,
                          message: 'Sadece sayı '
                      },
                      between: {
                          min: 1,
                          max: 11,
                          message: 'Şube numarası 1 ile 11 arasında olmalıdır'
                      },
                      remote: {
                          url: base_url + 'sube/checkno',
                          data: { sube_no:
                               function() {
                                	return $( "#sube_no" ).val();
                               },
                               sube_id:function() {
                              	 return $('input:hidden[name=sube_id]').val();
                               }
                            },
                          message: 'Bu Şube numarası kullanılmış',
                          type: 'POST'
                      }                           
                  }
              }
               		
        }
    })
    .on('success.validator.fv', function(e, data) {
        // data.field     --> The field name
        // data.element   --> The field element
        // data.result    --> The result returned by the validator
        // data.validator --> The validator name

        if (data.field === 'sube_no'
            && data.validator === 'remote'
            && (data.result.available === false || data.result.available === 'false'))
        {
        	
            // The userName field passes the remote validator
            data.element                    // Get the field element
                .closest('.form-group')     // Get the field parent

                // Add has-warning class
                .removeClass('has-success')
                .addClass('has-warning')

                // Show message
                .find('small[data-fv-validator="remote"][data-fv-for="tc"]')
                    .show();
        }
    });
    
    /*kullanıcı kayıt kontrol */
    $('#userForm')
    .formValidation({
    	locale: 'tr_TR',
        message: 'This value is not valid',
        //live: 'submitted',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
               validators: {
                    notEmpty: {},
                    stringLength: {
                        min: 3,
                        max: 240,
                        message: 'Kullanıcı adı minimum 3 maksimum 16 karakter içerebilir'
                    }                          
                }
            },
            password: {
                validators: {
                    identical: {
                    	
                        field: 'confirm_password',
                        message: 'Şifre doğrulama ile eşleşmiyor'
                    },
                    notEmpty: { message: 'Şifre boş bırakılamaz' },
                    stringLength: {
                        min: 6,
                        max: 12,
                        message: 'Şifre minimum 6 maksimum 12 karakterli olabilir.'
                    }
                }
            },
            confirm_password: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'Doğrulama şifre ile eşleşmiyor eşleşmiyor'
                    }
                }
            },
            type: {
                validators: {
                	notEmpty: { message: 'Kullanıcı tipi boş bırakılamaz' }                                           
                 }
             },
             sube_id: {
                 validators: {
                	 notEmpty: { message: 'Şube boş bırakılamaz' }                                            
                  }
              },
             email: {
                 validators: {
                      notEmpty: {},
                      emailAddress: {message: 'email formatı uygun değil.'},
                      stringLength: {
                          min: 8,
                          max: 60,
                          message: 'email minimum 8 maksimum 60 karakter içerebilir'
                      },
                      remote: {
                          url: base_url + 'user/emailcheck',
                          data: { email:
                               function() {  	
                                	return $("#email").val();
                               },
                               id:function() {
                              	 return $('input:hidden[name=id]').val();
                               }
                            },
                          message: 'Bu email adresi kullanılmış',
                          type: 'POST'
                      }                           
                  }
              }
               		
        }
    })
    .on('success.validator.fv', function(e, data) {
        // data.field     --> The field name
        // data.element   --> The field element
        // data.result    --> The result returned by the validator
        // data.validator --> The validator name

        if (data.field === 'email'
            && data.validator === 'remote'
            && (data.result.available === false || data.result.available === 'false'))
        {
        	
            // The userName field passes the remote validator
            data.element                    // Get the field element
                .closest('.form-group')     // Get the field parent

                // Add has-warning class
                .removeClass('has-success')
                .addClass('has-warning')

                // Show message
                .find('small[data-fv-validator="remote"][data-fv-for="tc"]')
                    .show();
        }
    });
    
    /*user kayıt kontrol sonu*/
    
    
    /* defter kayit formu*/
    
    $('#defterForm')
    .formValidation({
    	locale: 'tr_TR',
        message: 'Geçerli bir değer giriniz',
        //live: 'submitted',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            no: {
               validators: {
                    notEmpty: {	message: 'Defter No boş bırakılamaz'},
                    regexp: { regexp: /^[0-9]+$/,  message: 'No Sadece sayı olmalıdır' },
                    stringLength: { min: 0,  max: 5,  message: 'No: maksimum üç karater olmalıdır.' }                          
                }
            },
            tarih: {
                validators: {
                	date: { format: 'DD-MM-YYYY'},
                    notEmpty: { message: 'Tarih boş bırakılamaz' }                                           
                 }
             },
             icerik: {
                 validators: {
                 	notEmpty: { message: 'Ä°çerik Metni Giriniz' }                                           
                  }
              },
              konu: {
                  validators: {
                  	notEmpty: { message: 'Lütfen bir konu giriniz.' }                                           
                   }
              }
        }
    })
    .on('success.validator.fv', function(e, data) {
        // data.field     --> The field name
        // data.element   --> The field element
        // data.result    --> The result returned by the validator
        // data.validator --> The validator name

        if (data.field === 'no'
            && data.validator === 'remote'
            && (data.result.available === false || data.result.available === 'false'))
        {
        	
            // The userName field passes the remote validator
            data.element                    // Get the field element
                .closest('.form-group')     // Get the field parent

                // Add has-warning class
                .removeClass('has-success')
                .addClass('has-warning')

                // Show message
                .find('small[data-fv-validator="remote"][data-fv-for="tc"]')
                    .show();
        }
    });
    
    /*defter kayıt kontrol sonu*/
    
    /* yonetim kayit formu*/
    $('#yonetimForm')
    .formValidation({
    	locale: 'tr_TR',
        message: 'This value is not valid',
        //live: 'submitted',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            isim: {
               validators: {
                    notEmpty: {	message: 'Ad soyad boş bırakılamaz' },
                    stringLength: { min: 3, max: 45, message: 'Ad soyad minimum iç karater maksimum 45 karakter olmalıdır.' }                          
                }
            },
            sira: {
                  validators: {
                	notEmpty: { message: 'Lütfen bir sıra no giriniz.' },
                  	regexp: { regexp: /^[0-9]+$/, message: 'No Sadece sayı olmalıdır'}
                   }
            }
        }
    })
    .on('success.validator.fv', function(e, data) {
        // data.field     --> The field name
        // data.element   --> The field element
        // data.result    --> The result returned by the validator
        // data.validator --> The validator name

        if (data.field === 'isim'
            && data.validator === 'remote'
            && (data.result.available === false || data.result.available === 'false'))
        {
        	
            // The userName field passes the remote validator
            data.element                    // Get the field element
                .closest('.form-group')     // Get the field parent

                // Add has-warning class
                .removeClass('has-success')
                .addClass('has-warning')

                // Show message
                .find('small[data-fv-validator="remote"][data-fv-for="tc"]')
                    .show();
        }
    });
    
    /*yÃ¶netim kayıt kontrol sonu*/
    
    /* sifre degis formu*/
    $('#passwordForm')
    .formValidation({
    	locale: 'tr_TR',
        message: 'This value is not valid',
        //live: 'submitted',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            password: {
               validators: {
                    notEmpty: {	message: 'Lütfen eski şifrenizi giriniz.' },
                    stringLength: { min: 6, max: 12, message: 'Eski şifre minimum 6 maksimum 12 karakter içerebilir' }                          
                }
            },
            new_password: {
                validators: {
                    identical: {
                        field: 'confirm_password',
                        message: 'Yeni şifre doğrulama ile eşleşmiyor.'
                    },
                    stringLength: { min: 6, max: 12, message: 'Yeni şifre minimum 6 maksimum 12 karakter içerebilir.' }
                }
            },
            confirm_password: {
                validators: {
                    identical: {
                        field: 'new_password',
                        message: 'Yeni şifre doğrulama, şifre ile eşleşmiyor.'
                    }
                   
                }
            }
        }
    })
    .on('success.validator.fv', function(e, data) {
        // data.field     --> The field name
        // data.element   --> The field element
        // data.result    --> The result returned by the validator
        // data.validator --> The validator name

        if (data.field === 'password'
            && data.validator === 'remote'
            && (data.result.available === false || data.result.available === 'false'))
        {
        	
            // The userName field passes the remote validator
            data.element                    // Get the field element
                .closest('.form-group')     // Get the field parent

                // Add has-warning class
                .removeClass('has-success')
                .addClass('has-warning')

                // Show message
                .find('small[data-fv-validator="remote"][data-fv-for="tc"]')
                    .show();
        }
    });
    
    /*sifre degis kayıt kontrol sonu*/
});
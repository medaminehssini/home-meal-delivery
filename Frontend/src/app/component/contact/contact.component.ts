import { Component, OnInit } from '@angular/core';
import { FormGroup, Validators, FormControl } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { Global } from 'src/app/entities/global.entity';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-contact',
  templateUrl: './contact.component.html',
  styleUrls: ['./contact.component.css']
})
export class ContactComponent implements OnInit {
  contactForm ;
  global = new Global();
  issent = false;
  errors = null;
  constructor(
    private http: HttpClient,
    private toastr: ToastrService

  ) { }

  ngOnInit() {
    this.contactForm = new FormGroup({
      fname   : new FormControl('', [Validators.required, Validators.minLength(4), Validators.maxLength(20) ]),
      lname   : new FormControl('', [Validators.required, Validators.minLength(4), Validators.maxLength(20) ]),
      email   : new FormControl('', [Validators.required, Validators.email]),
      tel     : new FormControl('', [Validators.required,  Validators.minLength(8), Validators.maxLength(12)]),
      subject : new FormControl('', [Validators.required,  Validators.minLength(4), Validators.maxLength(100)]),
      message : new FormControl('', [Validators.required,  Validators.minLength(10), Validators.maxLength(255)])
    });
    this.getMap();
  }


  onSubmit(form) {
    this.issent = true;
    this.setContact();
  }


  setContact() {
    return this.http.post(this.global.apiURL + 'api/contact', this.contactForm.value ).subscribe(
      data => {
        this.issent = false;
        this.contactForm.reset();
        this.toastr.success('Votre message a été envoyé avec succès');
      },
      error => {
        this.issent = false;
        console.error(Object(error).error.error);
        this.errors = Object(error).error.error;
        this.toastr.error('Vérifier votre donner');
      }
    );
  }

  getMap() {
    const options = {
      center: new google.maps.LatLng(34.7990306, 10.7545899),
      zoom: 18,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    const maps = new google.maps.Map(document.getElementById('map'), options);
    const marker = new google.maps.Marker({
      position: new google.maps.LatLng(34.7990306, 10.7545899),
      map: maps,
      icon:  {
        url: this.global.apiURL + '/images/maps/origin.png',
        scaledSize : new google.maps.Size(50, 50),
    }
    });
    const infoWindowOptions = {
      // tslint:disable:max-line-length
      // tslint:disable-next-line:quotemark
      content: '<img style="width:260px;height:143px" class="wwone__map-infobox__thumb" src="' + this.global.verifLogo("/images/kgsexpress.png", "d") + '" />' +
       '<div class="wwone__map-infobox__inner">' +
       '<div class="wwone__map-infobox__inner__heading">' + this.global.siteName + '</div>' +
       '<div class="wwone__map-infobox__inner__info"><div class="wwone__map-infobox__inner__info__type">' +
       '<strong>Téléphone:</strong>' + this.global.telephone + '</div><div class="wwone__map-infobox__inner__info__location">'
       + '<strong>Adresse:</strong> ' + this.global.adresse + '</div><div class="wwone__map-infobox__inner__info__date">' +
       '<strong>Ville:</strong> ' + this.global.ville + '</div></div>'
       };
    const infoWindow = new google.maps.InfoWindow(infoWindowOptions);
    // tslint:disable-next-line:only-arrow-functions
    google.maps.event.addListener(marker, 'click', function() {
      infoWindow.open(this.map, marker);
    }.bind(this));
  }


}

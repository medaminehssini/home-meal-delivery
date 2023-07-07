import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Global } from 'src/app/entities/global.entity';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { ToastrService } from 'ngx-toastr';
import { UserDataService } from 'src/app/services/user-data.service';

@Component({
  selector: 'app-edit',
  templateUrl: './edit.component.html',
  styleUrls: ['./edit.component.css' , '../app-user/app-user.component.css' ]
})
export class EditComponent implements OnInit {
  global = new Global();
  user = null;
  errors = null;
  settingForm = new FormGroup({});
  constructor(
    private http: HttpClient,
    private toastr: ToastrService,
    private dataUser: UserDataService
  ) { }

  ngOnInit() {
    this.dataUser.currentMessage.subscribe(message => {
      this.user = message;
      this.getForm();
    });
  }
  getForm() {
    this.settingForm = new FormGroup({
      nom        : new FormControl(this.user.nom, [Validators.required]),
      prenom     : new FormControl(this.user.prenom, [Validators.required]),
      email      : new FormControl(this.user.email, [Validators.required, Validators.email]),
      adresse    : new FormControl(this.user.adresse, [Validators.required]),
      telephone  : new FormControl(this.user.telephone, [Validators.required]),
      ville      : new FormControl(this.user.ville, [Validators.required]),
      codePostale: new FormControl(this.user.codePostale, [Validators.required]),
      password: new FormControl('', [Validators.required]),
      password_confirmation: new FormControl('', [Validators.required]),
      oldpassword: new FormControl('', [Validators.required]),
    });
  }

  setimage(event) {
    const image = document.getElementById('Userphoto') as HTMLImageElement;
    image.src = event.srcElement.src;
  }

  setDataUser() {
    this.errors = null;
    this.http.put(this.global.apiURL + 'api/edit/profile', this.settingForm.value).subscribe(success => {
      this.settingForm.get('password').reset();
      this.settingForm.get('password_confirmation').reset();
      this.settingForm.get('oldpassword').reset();
      this.dataUser.getData();
      this.toastr.success('votre profil a été modifié avec succès');
    }, error => {
      this.errors = Object(error).error;
    }
    );
  }

}

import { Component, OnInit } from '@angular/core';
import { FormGroup, Validators, FormControl } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { Global } from 'src/app/entities/global.entity';
import { ToastrService } from 'ngx-toastr';
import { AuthService } from 'src/app/services/auth.service';
import { Router } from '@angular/router';
@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  RegisterForm ;
  global = new Global();
  issent = false;
  errors = null;

  constructor(
    private http: HttpClient,
    private toastr: ToastrService,
    private auth: AuthService,
    private router: Router
    ) { }

  ngOnInit(): void {
    if (this.auth.logedIn()) {
        this.router.navigate(['/home']);
    }
    this.RegisterForm = new FormGroup({
      nom                   : new FormControl('', [Validators.required, Validators.minLength(3), Validators.maxLength(20) ]),
      prenom                : new FormControl('', [Validators.required, Validators.minLength(3), Validators.maxLength(20) ]),
      email                 : new FormControl('', [Validators.required, Validators.email]),
      telephone             : new FormControl('', [Validators.required,  Validators.minLength(8), Validators.maxLength(12)]),
      adresse               : new FormControl('', [Validators.required,  Validators.minLength(4), Validators.maxLength(100)]),
      ville                 : new FormControl('', [Validators.required,  Validators.minLength(1), Validators.maxLength(25)]),
      codePostale           : new FormControl('', [Validators.required,  Validators.minLength(1), Validators.maxLength(25)]),
      type                  : new FormControl('client', []),
      password              : new FormControl('', [Validators.required,  Validators.minLength(6), Validators.maxLength(25)]),
      password_confirmation : new FormControl('', [Validators.required,  Validators.minLength(6), Validators.maxLength(25)])
    });
  }
  onSubmit() {
    this.issent = true;
    this.setContact();
  }

  setContact() {
    return this.http.post(this.global.apiURL + 'api/register', this.RegisterForm.value ).subscribe(
      data => {
        this.issent = false;
        this.toastr.success('Votre compte a bien été créé');
        if (this.RegisterForm.get('type').value === 'fournisseur') {
          setTimeout(() => {
            window.location.href = this.global.apiURL + 'login/fournisseur';
          }, 500);
        }
        this.RegisterForm.reset();
        this.router.navigate(['/']);

      },
      error => {
        this.issent = false;
        console.error(Object(error).error.error);
        this.errors = Object(error).error.error;
        this.toastr.error('Vérifier votre donner');
      }
    );
  }

}

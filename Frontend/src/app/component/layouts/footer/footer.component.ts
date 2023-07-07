import { Component, OnInit } from '@angular/core';
import { AuthService } from 'src/app/services/auth.service';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.css']
})
export class FooterComponent implements OnInit {

  issent = false ;
  constructor(
    private auth: AuthService,
    private toast: ToastrService
  ) { }
  loginForm  = new FormGroup({
    email   : new FormControl('', [Validators.required, Validators.email]),
    password     : new FormControl('', [Validators.required,  Validators.minLength(6), Validators.maxLength(12)]),
  });
  ngOnInit() {
  }


  login() {
    this.issent = true;
    this.auth.login(this.loginForm.value).subscribe(
      success => {
        console.log(success);
        this.auth.setToken(Object(success).success.token);
        this.loginForm.reset();
        document.getElementById('closeLoginForm').click();
        this.toast.success('Connexion avec succès');
        this.issent = false;
      },
      error => {
        console.log(error);
        this.toast.error('Email ou mot de passe incorrect');
        this.issent = false;
      }
    );
  }

  closeLogin() {
    document.getElementById('closeLoginForm').click();
  }

}

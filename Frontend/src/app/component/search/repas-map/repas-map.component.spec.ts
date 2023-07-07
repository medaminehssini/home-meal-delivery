import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { RepasMapComponent } from './repas-map.component';

describe('RepasMapComponent', () => {
  let component: RepasMapComponent;
  let fixture: ComponentFixture<RepasMapComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ RepasMapComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(RepasMapComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

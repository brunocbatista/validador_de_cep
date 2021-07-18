import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DetailZipCodeComponent } from './detail-zip-code.component';

describe('DetailZipCodeComponent', () => {
  let component: DetailZipCodeComponent;
  let fixture: ComponentFixture<DetailZipCodeComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DetailZipCodeComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(DetailZipCodeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});

package com.eventia.demo.dto.ayuntamientos;

public class AyuntamientoUpdateDTO {

	public enum TipoEvento {
		CONCIERTOS, FERIAS, FESTIVALES, OTRO
	}

	public enum Frecuencia {
		OCASIONALMENTE, VARIAS_VECES_AL_ANO, MENSUALMENTE
	}

	public enum TipoEspacio {
		PLAZA_PUBLICA, AUDITORIO, RECINTO_CERRADO, OTRO
	}

	public enum TipoFacturacion {
		CORREO, PLATAFORMA
	}

	private Integer id; // ID del ayuntamiento a actualizar
	private String nombreInstitucion;
	private String imagen;
	private String comunidadAutonoma;
	private String localidad;
	private String provincia;
	private String telefono;
	private String emailContacto;
	private TipoEvento tipoEvento; // conciertos, ferias, festivales, otro
	private Frecuencia frecuencia; // ocasionalmente, varias veces al año, mensualmente
	private TipoEspacio tipoEspacio; // plaza pública, auditorio, recinto cerrado, otro
	private String opcionesAccesibilidad;
	private TipoFacturacion tipoFacturacion; // correo, plataforma
	private String logisticaPropia;

	public AyuntamientoUpdateDTO(Integer id, String nombreInstitucion, String imagen, String comunidadAutonoma,
			String localidad, String provincia, String telefono, String emailContacto, TipoEvento tipoEvento,
			Frecuencia frecuencia, TipoEspacio tipoEspacio, String opcionesAccesibilidad,
			TipoFacturacion tipoFacturacion, String logisticaPropia) {
		super();
		this.id = id;
		this.nombreInstitucion = nombreInstitucion;
		this.imagen = imagen;
		this.comunidadAutonoma = comunidadAutonoma;
		this.localidad = localidad;
		this.provincia = provincia;
		this.telefono = telefono;
		this.emailContacto = emailContacto;
		this.tipoEvento = tipoEvento;
		this.frecuencia = frecuencia;
		this.tipoEspacio = tipoEspacio;
		this.opcionesAccesibilidad = opcionesAccesibilidad;
		this.tipoFacturacion = tipoFacturacion;
		this.logisticaPropia = logisticaPropia;
	}

	public AyuntamientoUpdateDTO() {
		super();
	}

	public Integer getId() {
		return id;
	}

	public void setId(Integer id) {
		this.id = id;
	}

	public String getNombreInstitucion() {
		return nombreInstitucion;
	}

	public void setNombreInstitucion(String nombreInstitucion) {
		this.nombreInstitucion = nombreInstitucion;
	}

	public String getImagen() {
		return imagen;
	}

	public void setImagen(String imagen) {
		this.imagen = imagen;
	}

	public String getComunidadAutonoma() {
		return comunidadAutonoma;
	}

	public void setComunidadAutonoma(String comunidadAutonoma) {
		this.comunidadAutonoma = comunidadAutonoma;
	}

	public String getLocalidad() {
		return localidad;
	}

	public void setLocalidad(String localidad) {
		this.localidad = localidad;
	}

	public String getProvincia() {
		return provincia;
	}

	public void setProvincia(String provincia) {
		this.provincia = provincia;
	}

	public String getTelefono() {
		return telefono;
	}

	public void setTelefono(String telefono) {
		this.telefono = telefono;
	}

	public String getEmailContacto() {
		return emailContacto;
	}

	public void setEmailContacto(String emailContacto) {
		this.emailContacto = emailContacto;
	}

	public TipoEvento getTipoEvento() {
		return tipoEvento;
	}

	public void setTipoEvento(TipoEvento tipoEvento) {
		this.tipoEvento = tipoEvento;
	}

	public Frecuencia getFrecuencia() {
		return frecuencia;
	}

	public void setFrecuencia(Frecuencia frecuencia) {
		this.frecuencia = frecuencia;
	}

	public TipoEspacio getTipoEspacio() {
		return tipoEspacio;
	}

	public void setTipoEspacio(TipoEspacio tipoEspacio) {
		this.tipoEspacio = tipoEspacio;
	}

	public String getOpcionesAccesibilidad() {
		return opcionesAccesibilidad;
	}

	public void setOpcionesAccesibilidad(String opcionesAccesibilidad) {
		this.opcionesAccesibilidad = opcionesAccesibilidad;
	}

	public TipoFacturacion getTipoFacturacion() {
		return tipoFacturacion;
	}

	public void setTipoFacturacion(TipoFacturacion tipoFacturacion) {
		this.tipoFacturacion = tipoFacturacion;
	}

	public String getLogisticaPropia() {
		return logisticaPropia;
	}

	public void setLogisticaPropia(String logisticaPropia) {
		this.logisticaPropia = logisticaPropia;
	}

}

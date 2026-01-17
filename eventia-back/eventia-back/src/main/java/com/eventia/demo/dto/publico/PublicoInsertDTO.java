package com.eventia.demo.dto.publico;

public class PublicoInsertDTO {

	private int id_usuario;
	private String comunidad_autonoma;
	private String provincia;
	private String localidad;
	private String gustos_musicales;
	private String tipo_eventos_favoritos;
	private boolean notificaciones;

	public PublicoInsertDTO(int id_usuario, String comunidad_autonoma, String provincia, String localidad,
			String gustos_musicales, String tipo_eventos_favoritos, boolean notificaciones) {
		super();
		this.id_usuario = id_usuario;
		this.comunidad_autonoma = comunidad_autonoma;
		this.provincia = provincia;
		this.localidad = localidad;
		this.gustos_musicales = gustos_musicales;
		this.tipo_eventos_favoritos = tipo_eventos_favoritos;
		this.notificaciones = notificaciones;
	}

	public PublicoInsertDTO() {
		super();
	}

	public int getId_usuario() {
		return id_usuario;
	}

	public void setId_usuario(int id_usuario) {
		this.id_usuario = id_usuario;
	}

	public String getComunidad_autonoma() {
		return comunidad_autonoma;
	}

	public void setComunidad_autonoma(String comunidad_autonoma) {
		this.comunidad_autonoma = comunidad_autonoma;
	}

	public String getProvincia() {
		return provincia;
	}

	public void setProvincia(String provincia) {
		this.provincia = provincia;
	}

	public String getLocalidad() {
		return localidad;
	}

	public void setLocalidad(String localidad) {
		this.localidad = localidad;
	}

	public String getGustos_musicales() {
		return gustos_musicales;
	}

	public void setGustos_musicales(String gustos_musicales) {
		this.gustos_musicales = gustos_musicales;
	}

	public String getTipo_eventos_favoritos() {
		return tipo_eventos_favoritos;
	}

	public void setTipo_eventos_favoritos(String tipo_eventos_favoritos) {
		this.tipo_eventos_favoritos = tipo_eventos_favoritos;
	}

	public boolean isNotificaciones() {
		return notificaciones;
	}

	public void setNotificaciones(boolean notificaciones) {
		this.notificaciones = notificaciones;
	}

}

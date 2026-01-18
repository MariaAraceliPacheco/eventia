package com.eventia.demo.dto.publico;

import io.swagger.v3.oas.annotations.media.Schema;

public class PublicoDTO {

	public enum GustosMusicales {
		rock, pop, reggaeton, metal
	}

	public enum TipoEventosFavoritos {
		festivales, ferias, conciertos, otro
	}

	private String comunidad_autonoma;
	private String provincia;
	private String localidad;

	@Schema(description = "Gustos musicales", example = "rock, pop, reggaeton o metal", allowableValues = { "rock",
			"pop", "reggaeton", "metal" })
	private GustosMusicales gustos_musicales;

	@Schema(description = "Tipo de eventos favoritos", example = "festivales, ferias, conciertos o otro", allowableValues = {
			"festivales", "ferias", "conciertos", "otro" })
	private TipoEventosFavoritos tipo_eventos_favoritos;
	private boolean notificaciones;

	public PublicoDTO(String comunidad_autonoma, String provincia, String localidad, GustosMusicales gustos_musicales,
			TipoEventosFavoritos tipo_eventos_favoritos, boolean notificaciones) {
		super();
		this.comunidad_autonoma = comunidad_autonoma;
		this.provincia = provincia;
		this.localidad = localidad;
		this.gustos_musicales = gustos_musicales;
		this.tipo_eventos_favoritos = tipo_eventos_favoritos;
		this.notificaciones = notificaciones;
	}

	public PublicoDTO() {
		super();
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

	public GustosMusicales getGustos_musicales() {
		return gustos_musicales;
	}

	public void setGustos_musicales(GustosMusicales gustos_musicales) {
		this.gustos_musicales = gustos_musicales;
	}

	public TipoEventosFavoritos getTipo_eventos_favoritos() {
		return tipo_eventos_favoritos;
	}

	public void setTipo_eventos_favoritos(TipoEventosFavoritos tipo_eventos_favoritos) {
		this.tipo_eventos_favoritos = tipo_eventos_favoritos;
	}

	public boolean isNotificaciones() {
		return notificaciones;
	}

	public void setNotificaciones(boolean notificaciones) {
		this.notificaciones = notificaciones;
	}

}

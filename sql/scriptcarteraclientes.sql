USE [KAO_wssp]
GO
/****** Object:  Table [dbo].[carteracliente_nuevos]    Script Date: 17/12/2019 12:52:52 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[carteracliente_nuevos](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[codigo] [nchar](10) NOT NULL,
	[fecha] [date] NULL,
	[asesor] [nchar](13) NULL,
	[clienteCI] [nchar](13) NULL,
	[cliente] [nchar](50) NULL,
	[clienteFecha] [date] NULL,
	[clienteEmail] [nchar](50) NULL,
	[clienteEstadoCivil] [nchar](3) NULL,
	[clienteHijos] [nchar](3) NULL,
	[sexo] [nchar](1) NULL,
	[deporte] [nchar](3) NULL,
	[tipoinformacion] [nchar](100) NULL,
	[marca] [nchar](3) NULL,
	[comentarios] [nchar](200) NULL
) ON [PRIMARY]
GO

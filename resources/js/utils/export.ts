export const exportToCSV = (data: any[], filename: string) => {
  if (!data || data.length === 0) {
    return
  }

  // Get headers from first object
  const headers = Object.keys(data[0])
  
  // Create CSV content
  let csvContent = headers.join(',') + '\n'
  
  data.forEach(item => {
    const row = headers.map(header => {
      let value = item[header]
      
      // Handle null/undefined values
      if (value === null || value === undefined) {
        value = ''
      }
      
      // Handle dates
      if (typeof value === 'string' && value.includes('T')) {
        try {
          value = new Date(value).toLocaleDateString('pt-BR')
        } catch (e) {
          // Keep original value if not a valid date
        }
      }
      
      // Escape quotes and wrap in quotes if contains comma
      if (typeof value === 'string') {
        value = value.replace(/"/g, '""')
        if (value.includes(',') || value.includes('\n') || value.includes('"')) {
          value = `"${value}"`
        }
      }
      
      return value
    })
    
    csvContent += row.join(',') + '\n'
  })

  // Create and download file
  const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' })
  const link = document.createElement('a')
  
  if (link.download !== undefined) {
    const url = URL.createObjectURL(blob)
    link.setAttribute('href', url)
    link.setAttribute('download', filename)
    link.style.visibility = 'hidden'
    document.body.appendChild(link)
    link.click()
    document.body.removeChild(link)
  }
}

export const formatDataForExport = (requests: any[]) => {
  return requests.map(request => ({
    'ID': request.id,
    'Solicitante': request.requester_name,
    'Email': request.user?.email || 'N/A',
    'Destino': request.destination,
    'Data Partida': request.departure_date,
    'Data Retorno': request.return_date,
    'Justificativa': request.purpose,
    'Observações': request.notes || 'N/A',
    'Status': request.status === 'pending' ? 'Pendente' : request.status === 'approved' ? 'Aprovado' : 'Cancelado',
    'Criado em': request.created_at,
    'Atualizado em': request.updated_at
  }))
}
